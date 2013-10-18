
			
		<ul id="articles">
			
			<?php
				require_once 'include/mysqli_connect.php';
				
				$q = "SELECT A.id, A.titulo, A.imagen, LEFT(A.contenido, 300) as contenido, A.fecha, A.id_seccion, M.nombre, U.nick FROM articulos A, menus M, users U WHERE (M.padre = 8 OR M.id = 8) AND M.id = A.id_seccion AND A.id_user = U.id ORDER BY fecha DESC LIMIT 5"; 
				$r = mysqli_query($con, $q);
			
				if ( $r ) {
				
					while ( $row = mysqli_fetch_array($r, MYSQLI_ASSOC) ) {
						
						$qq = "SELECT COUNT(*) FROM comentarios WHERE article_id = " . $row['id']; 
						$rr = mysqli_query($con, $qq);
						
						$roww = mysqli_fetch_array($rr, MYSQLI_NUM);
						$numComments = $roww[0];
						
						setlocale(LC_TIME, 'es_ES');
						
						$h =  strtotime($row['fecha']);
						
						$day = strftime('%e', $h);
						$month = strftime('%h', $h);
						
						$urltitle = str_replace( " ", "-", $row['titulo']);
						
						$lastchar = strrpos($row['contenido'], ' ', 0);
						$content = substr($row['contenido'], 0, $lastchar);
						
						echo '<li> <div class="articleMeta">';
								
								echo '<p>' . $month . '<br /><span>' . $day . '</span>th </p>';
								echo '<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="col_sedaval" data-lang="es">Tweet</a>
									 <a href="http://www.tuenti.com/share" class="tuenti-share-button" icon-style="light"></a>
									
									<div id="fb-root"></div>
									<fb:like href="?sid='.$row['id_seccion'].'&id=' . $row['id'] . '&title=' . $urltitle . '" send="false" layout="button_count" show_faces="false" font=""></fb:like>';
							echo '</div> <div class="articleBody">';
								
								echo '<h3><a href="?sid='.$row['id_seccion'].'&id=' . $row['id'] . '&title=' . $urltitle . '">' . $row['titulo'] . '</a></h3>';
								echo '<span> por ' . $row['nick'] . ' <abbr class="timeago" title="' .$row['fecha']. '">' .
								strftime("%e %B, %y", strtotime($row['fecha'])) . ' </abbr> en ' . $row['nombre'] . '</span>';
								
								echo '<a href="?sid='.$row['id_seccion'].'&id=' . $row['id'] . '&title=' . $urltitle . '" > <img class="imgLeft" src="' . $row['imagen'] .'" alt"" /> </a>';
								
								echo '<p>' . nl2br( $content ) . '<a href="?sid='.$row['id_seccion'].'&id=' . $row['id'] . '&title=' . $urltitle . '" > &#0133; </a> </p>';
								
							echo '<a href="?sid='.$row['id_seccion'].'&id=' . $row['id'] . '&title=' . $urltitle . '" class="expandArticle">' 
									.$numComments. ' Comentarios
								</a>
							</div>
									
							</li>';
						
					}
				}
			?>
			
		</ul>
