<?php

class News extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function tag_check($tag = '')
	{
	    if (empty($tag))
	    {
			return FALSE;
	    }

	    return $this->db->where('name', $tag)
			    ->count_all_results('tags') > 0;
	}
	
	// Revisar, que cuente el numero de noticias con un tag especifico!
	function count_all( $tag = NULL) {
		
		$this->db->from('news');
		
		if (is_array($tag))
		{
			$this->db->join('news_tags', 'news.id = news_tags.newsId', 'left');
			$this->db->join('tags', 'news_tags.tagId = tags.id', 'left');
			
			$this->db->where($tag);
		}
		
		return $this->db->count_all_results();
	} 
	
	function create($data = '', $tags = '') {
 		if (is_array($data)) {
 			$data['visits'] = 0;
 			$data['date'] = now();
 			
 			if($this->db->insert('news', $data))
 			{
 				$newsId = $this->db->insert_id();
 				if (is_array($tags)) {
 					foreach ($tags as $value) {
 						if (!$this->tag_check($value)) {
 							$this->db->insert('tags', array( 'name' => $value));
 							$tagId = $this->db->insert_id();
 							$this->db->insert('news_tags', array( 'newsId' => $newsId,
 																  'tagId' => $tagId ));
 						} else {
 							$tagInfo = $this->db->where('name', $value)->get('tags')->row_array();
 							$this->db->insert('news_tags', array( 'newsId' => $newsId,
 																  'tagId' => $tagInfo['id'] ));
 						}
 					}
 					return TRUE;
 				} else {
 					return FALSE;
 				}
 			} else {
 				return FALSE;
 			}
 		} else {
 			return FALSE;
 		}
    }
    
    function update($id, $data, $tiene = '') {
        $this->db->where('id', $id);
        $this->db->update('news', $data);
        
        if (is_array($tiene)) {
        	
        	$existentes = array();
        	$query = $this->db->get('tags')->result_array();
        	foreach ($query as $value) {
        		$existentes[] = $value['name'];
        	}
        	$tenia = array();
        	$query = $this->get_tags_array($id);
        	foreach ($query as $value) {
        		$tenia[] = $value['name'];
        	}
        	
        	$aborrar = array_diff($tenia, $tiene);
        	$nuevas = array_diff($tiene, $tenia);
        	$ainsertar = array_diff( $nuevas, $existentes);
        	$ainsertar_tupla = array_diff( $nuevas, $ainsertar);
        	
        	// Borramos las tuplas que hemos quitado
        	$aborrarStr = implode("', '", $aborrar);
        	$sql = "DELETE FROM news_tags 
        	        WHERE news_tags.tagId IN (SELECT tags.id FROM tags WHERE tags.name in ('$aborrarStr'))";
        	$this->db->query($sql);
        	
        	// insertamos en ambas tablas las tags nuevas nuevas
        	foreach ($ainsertar as $value) {
        		$this->db->insert('tags', array( 'name' => $value));
        		$tagId = $this->db->insert_id();
        		$this->db->insert('news_tags', array( 'newsId' => $id,
        											  'tagId' => $tagId ));
        	}
        	
        	// insertamos la tupla con la tag que ya existia
        	foreach ($ainsertar_tupla as $value) {
        		$tagInfo = $this->db->where('name', $value)->get('tags')->row_array();
        		$this->db->insert('news_tags', array( 'newsId' => $id,
        											  'tagId' => $tagInfo['id'] ));
        	}
        }
        return $this->db->affected_rows() == 1;
    }
    
    function delete($id) {
        $this->db->trans_begin();
        
        $query = $this->db->where('articleId',$id)->get('images');
        
        $this->db->delete('images', array('articleId' => $id));
        $this->db->delete('news_tags', array('newsId' => $id));
	    $this->db->delete('news', array('id' => $id));

	    if ($this->db->trans_status() === FALSE)
	    {
			$this->db->trans_rollback();
			return FALSE;
	    }

	    $this->db->trans_commit();
	    
	    
	    foreach ($query->result() as $row) {
	    	unlink('img/uploads/'.$row->name);
	    	unlink('img/uploads/thumb_'.$row->name);
	    }
	    
	    return TRUE;
    }
        
    function retrieve( $tags = '', $limit = NULL, $offset = NULL, $order='news.date DESC') 
    {
	  
	  if (!empty($limit)) 
	  {
	      if (!empty($offset)) 
	      {
	          $this->db->limit($limit, $offset);
	      } 
	      else 
	      {
	          $this->db->limit($limit);
	      }
	  }
	  
	  $this->db->select('news.*, GROUP_CONCAT(tags.name ORDER BY tags.name) AS tags_list, users.username');
	  $this->db->from('news');
	  $this->db->join('users', 'users.id = news.author');
	  $this->db->join('news_tags', 'news.id = news_tags.newsId', 'left');
	  $this->db->join('tags', 'news_tags.tagId = tags.id', 'left');
	  
	  $this->db->group_by('news.id');
	  
	  if (is_array($tags))
	  {
	  	$this->db->where($tags);
	  }
	  
	  if (!empty($order))
	  {
	  	$this->db->order_by($order);
	  }
	  
	  return $this->db->get();
	}
	
	function get_noticias($tag= '', $limit = NULL, $offset = NULL) {
		return $this->retrieve($tag, $limit, $offset)->result();
	}
	
	function get_noticias_array($criteria= '', $limit = NULL, $offset = NULL) {
		$this->load->model('Gallery');
		$articulos = $this->retrieve($criteria, $limit, $offset)->result_array();
		foreach ($articulos as &$articulo) {
			$articulo['images'] = $this->Gallery->get_images_array($articulo['id']);
			$articulo['tags'] = $this->get_tags_array($articulo['id']);
		}
		return $articulos;
	}
	
	function get_noticia($id) {
		$this->db->where($id);
		$this->db->limit(1);
		return $this->retrieve()->row();
	}
	
	function get_noticia_array($id) {
		//$this->db->where($id);
		//$this->db->limit(1);
		$this->load->model('Gallery');
		$articulo = $this->retrieve($id,1)->row_array();
		$articulo['images'] = $this->Gallery->get_images_array( $articulo['id']);
		$articulo['tags'] = $this->get_tags_array($id);
		return $articulo;
	}
	
	function get_noticias_by_tag() {
	
	}
    
    
    function get_noticias_by_tag_array() {
    
    }
    
    function get_tags_array($id) {
    	$this->db->distinct(); // ???
    	$this->db->select(array('tags.*'));
    	$this->db->join('news_tags','news_tags.tagId = tags.id');
    	
    	if (is_numeric($id)) {
    		$this->db->where('news_tags.newsId', $id);	
    	}
    	
    	return $this->db->get('tags')->result_array();
    	
    }
    
    function activate( $id ) {
    	$data = array( 'active' => 1
				 		);

		$this->db->update('news', $data, array('id' => $id));

    	return $this->db->affected_rows() == 1;
    }
    
    function deactivate( $id ) {
		$data = array( 'active' => 0
				 		);
	
		$this->db->update('news', $data, array('id' => $id));
	
		return $this->db->affected_rows() == 1;
    }
}