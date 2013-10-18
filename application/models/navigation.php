<?php

class Navigation extends CI_Model
{
	private $currSection;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function set_section($id)
	{
		if (!isset($id))
		{
			$id = 1;
		}
		
		$this->db->where('id', $id);
		$query = $this->db->get('menus2');
		
		if ($query->num_rows() > 0)
		{
			$this->currSection = $query->row_array();
		}
	}
	
	function activate_seccion( $id ) {
    	$data = array( 'active' => 1
				 		);

		$this->db->update('menus2', $data, array('id' => $id));

    	return $this->db->affected_rows() == 1;
    }
    
    function deactivate_seccion( $id ) {
		$data = array( 'active' => 0
				 		);
	
		$this->db->update('menus2', $data, array('id' => $id));
	
		return $this->db->affected_rows() == 1;
    }
	    
	function get_children_array($id=NULL) {
		if (!$id) {
			$id = 0;
			$this->db->where('name !=','home');
			$this->db->where('name !=','prensa');
		}
		
		$this->db->where('parent',$id);
		$this->db->order_by('id');
		
		return $this->db->get('menus2')->result_array();
	}
	
	function get_header_entries() {
		$top = $this->get_children_array();
		foreach ($top as &$value) {
			$value['children'] = $this->get_children_array($value['id']);
		}
		return $top;
	}
	
	function get_breadcrumbs($sectionSlug)
	{
		$this->db->select('id, nombre, slug, padre');
		$this->db->where('slug', $sectionSlug);
		$query = $this->db->get('menus');
		
		//$result = new stdClass();
		
		if ($query->num_rows() > 0)
		{
			$cont = 0;
			$row = $query->row_array();
			$result[$cont]['nombre'] = $row['nombre'];
			$result[$cont]['slug'] = $row['slug'];
			
			if ($row['padre'] != 0) {
				do {
				
					$this->db->select('id, nombre, slug, padre');
					$this->db->where('id', $row['padre']);
					$query = $this->db->get('menus');
					
					$cont += 1;
					$row = $query->row_array();
					$result[$cont]['nombre'] = $row['nombre'];
					$result[$cont]['slug'] = $row['slug'];
					
				} while ( $row['padre'] != 0 );
			}
			
			$result_rev = array_reverse($result);
		}
		
		return $result_rev;
		
	}
	
	function get_slider_entries($active = NULL) 
	{
		$this->db->select('slider.*, images.articleId, images.tipo, images.name');
		$this->db->join('images', 'slider.imageId = images.id');
		if ($active != NULL) {
			$this->db->where('slider.active', $active);
		}
		//$this->db->order_by('orden', 'asc');
		//$this->db->limit(4);
		
		$sliders = $this->db->get('slider')->result();
		
		foreach ($sliders as &$row) {
			switch ($row->tipo) {
				case 'noticia':
					$this->load->model('News');
					$noticia = $this->News->get_noticia(array('news.id' => $row->articleId));
					
					$h =  date('Y-m-d  hh:mm:ss',$noticia->date);
									
					$day = strftime('%e', $noticia->date);
					$day2 = strftime('%d',$noticia->date);
					$month = strftime('%h', $noticia->date);
					$month2 = strftime('%m', $noticia->date);
					$year = strftime('%Y', $noticia->date);
								
					$row->url = $year.'/'.$month2.'/'.$day2.'/'.$noticia->slug;
					$row->title = $noticia->title;
					break;
				case 'articulo':
					$this->load->model('Article');
					
					$where = array('articles.id' => $row->articleId);
					$articulo = $this->Article->get_articulo($where);
					
					$row->url = $articulo->section_slug;
					$row->title = $articulo->title;
					
					break;
				default:
					$url = 'default';
					break;
			}
		}
		
		
		return $sliders;
	}
	
	function activate_destacado( $id ) {
    	$data = array( 'active' => 1
				 		);

		$this->db->update('slider', $data, array('id' => $id));

    	return $this->db->affected_rows() == 1;
    }
    
    function deactivate_destacado( $id ) {
		$data = array( 'active' => 0
				 		);
	
		$this->db->update('slider', $data, array('id' => $id));
	
		return $this->db->affected_rows() == 1;
    }
	
	function create_destacado($data = '') {
		if (is_array($data)) {
			
			if($this->db->insert('slider', $data))
			{
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	
	function delete_destacado($where = '') {
        $this->db->trans_begin();
        
        $this->db->delete('slider', $where);

	    if ($this->db->trans_status() === FALSE)
	    {
			$this->db->trans_rollback();
			return FALSE;
	    }

	    $this->db->trans_commit();
	 
	    return TRUE;
    }
	       
	function get_section_array($selector) {
		
		$this->db->select('menus2.* , views.view');
		$this->db->join('views', 'menus2.viewId = views.id');
		$this->db->where($selector);
		
		return $this->db->get('menus2')->row_array();
	}
	
	function get_sectionName($slug) {
		$this->db->select('nombre');
		
		$this->db->where('slug', $slug);
		$query = $this->db->get('menus');
		
		$row = $query->row();
		
		return $row->nombre;
	}
	
	function get_sectionView($slug) {
		$this->db->select('vista');
		
		$this->db->where('slug', $slug);
		$query = $this->db->get('menus');
		
		$row = $query->row();
		
		return $row->vista;
	}
	
	function load_sidebar($widgets = array('mas_leidos', 'ultimos_comentarios', 'twitter')) {
		
		$output = '';
		foreach ($widgets as $value) {
			$name = 'widget_'.$value;
			$output .= $this->$name();
		}
		return $output;
	}
	
	
	function widget_secciones() {
		
		$children = $this->get_children_array($this->currSection['id']);
		
		if (isset($children) && !empty($children)) {
			$output = '
			<!--widget Secciones-->
			<li class="content-box drop-shadow lifted widget">
				<h4>Secciones</h4>
				<ul class="oneColumnList">';
			foreach ($children as $child) {
				$output .=	'<li>'.anchor($child['slug'],'&nbsp;&raquo;&nbsp;'.$child['name']).'</li>';
			}
			$output .= '</ul>
			</li> <!--end widget tags-->';
			
			return $output;
		}
		
		
	}
	
	function widget_tags() {
		
		//$this->db->select('id, sectionId, title, slug');
		$this->db->order_by('name');
		$this->db->limit(10);
		
		$tags = $this->db->get('tags')->result_array();
		
		$output = '
		<!--widget Tags-->
		<li class="content-box drop-shadow lifted widget">
			<h4>Tags</h4>
			<ul class="twoColumnList">';
			
		foreach ($tags as $tag) {
			
			$output .=	'<li>' . anchor('noticias/'.$tag['name'], '&nbsp;&raquo;&nbsp; '.$tag['name']).'</li>';
		}
		
		$output .= '	</ul>
			<div class="clear"></div>
		</li> <!--end widget tags-->';
		
		return $output;
	}
	
	function widget_mas_leidos() {
		
		$this->db->select('news.id, news.title, news.slug, news.date, news.visits');
		$this->db->order_by('news.visits desc');
		$this->db->limit(5);
		
		$query = $this->db->get('news');
		
		$output = '
		<!--widget mas Leidos-->
		<li class="content-box drop-shadow lifted widget">
			<h4>Mas leido</h4>
			<ul class="oneColumnList">';
			
		foreach ($query->result() as $row) {
			$date = strftime('%Y/%m/%d', $row->date);
			$output .=	'<li>' . anchor($date.'/'.$row->slug, '&nbsp;&raquo;&nbsp; '. $row->title).'</li>';
		}
		
		$output .= '	</ul>
		</li> <!--end widget mas Leidos-->';
		
		return $output;
	}
	
	function widget_ultimos_comentarios() {
		
		/*$output = '
		<!--widget ultimos comentarios-->
		<li>
			<h4>Ultimos comentarios</h4>
			<ul class="fullWidthList" id="commentsbar">
				<li>
					<p>
					Alsenes dijo:
					<span>Cualquier chorrada que se te ocurra</span> 
					<abbr class="timeago" title="1315518901">' .strftime("%a %e %b, %Y %R", strtotime(1315518901)). '</abbr>
					</p>
				 </li>
			</ul>
		</li>
		<!-- end widget ultimos comentarios-->';*/
		
		$output = '<li class="content-box drop-shadow lifted widget"><div id="recentcomments" class="dsq-widget"><h4 class="dsq-widget-title">Comentarios</h4><script type="text/javascript" src="http://sedaval.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=1&avatar_size=32&excerpt_length=50"></script></div><a href="http://disqus.com/">Powered by Disqus</a></li>';
		
		return $output;
	}
	
	function widget_twitter() {
		$output = '<li class="content-box drop-shadow lifted widget"><h4>Ultimos tweets</h4>';
		$output .= '<ul class="oneColumnList" id="tweet">
			<li>Cargando tweets...</li>
			<li><a href="http://twitter.com/rem"> Si no puedes esperar, visita mi perfil</a></li>
		</ul></li>';
		return $output;
	}
	
	
}
