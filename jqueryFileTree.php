<?php
//
// jQuery File Tree PHP Connector
//
// Version 1.01
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 24 March 2008
//
// History:
//
// 1.01 - updated to work with foreign characters in directory/file names (12 April 2008)
// 1.00 - released (24 March 2008)
//
// Output a list of files for jQuery File Tree
//

require 'utilities/database/videos.php';//pour utiliser la fonction getVideoFromAdress pour savoir si une vidéo a été traitée ou pas.

$_POST['dir'] = urldecode($_POST['dir']);
$root = './';

if( file_exists($root . $_POST['dir']) ) {
	$files = scandir($root . $_POST['dir']);
	natcasesort($files);
        
        //La partie suivante sert à filtrer les fichiers ajoutés, en ne gardant que les dossiers et les vidéos.
        $filestmp = $files;
        unset($files);
        foreach ($filestmp as $file) {
            if (preg_match("/(.mkv|.webm|.avi)$/", $file)||preg_match("/^[^\.]+$/",$file)) {//on ne garde que les extensions d'une liste blanche et les dossiers (fichiers sans . dans leur nom).
                $files[] = $file;
            }
        }
        //Fin de la partie ajoutée
        
	if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach( $files as $file ) {
			if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file) ) {
				echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
			}
		}
		// All files
		foreach( $files as $file ) {
			if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file) ) {
				$ext = preg_replace('/^.*\./', '', $file);
                                $video= Video::getVideoFromAdress(htmlentities($_POST['dir'] . $file));
                                if ($video == null) {//si la vidéo n'est pas encore dans la BDD
                                    echo "<li class=\"file ext_missing\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";//alors on affiche son icône
                                } else {
                                    //sinon on affiche quand même mais avec une classe qui fera qu'elle n'aura pas de javascript associée, et le lien renvoie vers l'affichage de la vidéo
                                    echo "<li class=\"file ext_check\"><a href=\"index.php?page=video&video={$video->video}\" target='_blank' rel='check'>" . htmlentities($file) . "</a></li>";
                                } 
				
			}
		}
		echo "</ul>";	
	}
}

?>