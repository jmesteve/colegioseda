<?php

class Article extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function count_all( $section = NULL) {
		if (is_string($section))
		{
			$this->db->where('sectionId', $section);
		}
		$this->db->from('articles');
		return $this->db->count_all_results();
	} 
	
	function create($data = '') {
 		if (is_array($data)) {
 			$data['visits'] = 0;
 			$data['date'] = now();
 			
 			if($this->db->insert('articles', $data))
 			{
 				return TRUE;
 			} else {
 				return FALSE;
 			}
 		} else {
 			return FALSE;
 		}
    }
    
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('articles', $data);
        
        return $this->db->affected_rows() == 1;
    }
    
    function delete($id) {
        $this->db->trans_begin();
        
        $query = $this->db->where('articleId',$id)->get('images');
        
        $this->db->delete('images', array('articleId' => $id));
	    $this->db->delete('articles', array('id' => $id));

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
    
    function search($terms, $start = 0, $results_per_page = 0)
    {
        // Determine whether we need to limit the results
        if ($results_per_page > 0)
        {
            $limit = "LIMIT $start, $results_per_page";
        }
        else
        {
            $limit = '';
        }
 
        // Execute our SQL statement and return the result
        $sql = "SELECT *
                    FROM articles
                    WHERE MATCH (title, content) AGAINST (?) > 0
                    $limit";
        $query = $this->db->query($sql, array($terms, $terms));
        return $query->result();
    }
    
    function count_search_results($terms)
    {
        // Run SQL to count the total number of search results
        $sql = "SELECT COUNT(*) AS count
                    FROM articles
                    WHERE MATCH (title,content) AGAINST (?)";
        $query = $this->db->query($sql, array($terms));
        return $query->row()->count;
    }
    
    function retrieve( $criteria = '', $limit = NULL, $offset = NULL, $order='articles.date DESC') 
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
	  
	  $this->db->select('articles.*, 
	  					 users.username as author_name, 
	  					 menus2.name as section_name, menus2.slug as section_slug');
	  $this->db->from('articles');
	  $this->db->join('users', 'users.id = articles.author');
	  $this->db->join('menus2', 'menus2.id = articles.sectionId');
	  
	  $this->db->group_by('articles.id');
	  
	  if (is_array($criteria))
	  {
	  	$this->db->where($criteria);
	  }
	  
	  if (!empty($order))
	  {
	  	$this->db->order_by($order);
	  }
	  
	  return $this->db->get();
	}
	
	function get_articulos($criteria= '', $limit = NULL, $offset = NULL) {
		return $this->retrieve($criteria, $limit, $offset)->result();
	}
	
	function get_articulos_array($criteria= '', $limit = NULL, $offset = NULL) {
		$this->load->model('Gallery');
		$articulos = $this->retrieve($criteria, $limit, $offset)->result_array();
		foreach ($articulos as &$articulo) {
			$articulo['images'] = $this->Gallery->get_images_array($articulo['id']);
		}
		return $articulos;
	}
	
	function get_articulo($id) {
		$this->db->where($id);
		$this->db->limit(1);
		return $this->retrieve()->row();
	}
	
	function get_articulo_array($id) {
		//$this->db->where($id);
		//$this->db->limit(1);
		$this->load->model('Gallery');
		$articulo = $this->retrieve($id,1)->row_array();
		$articulo['images'] = $this->Gallery->get_images_array($articulo['id']);
		return $articulo;
	}
	
    function activate( $articleId ) {
    	$data = array( 'active' => 1 );

		$this->db->update('articles', $data, array('id' => $articleId));

    	return $this->db->affected_rows() == 1;
    }
    
    function deactivate( $articleId ) {
		$data = array( 'active' => 0 );
	
		$this->db->update('articles', $data, array('id' => $articleId));
	
		return $this->db->affected_rows() == 1;
    }
}