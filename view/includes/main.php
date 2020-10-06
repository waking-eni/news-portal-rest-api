<!-- MAIN with pagination -->
<main class="col-9 main">
    <div class="main-card row">

        <?php
         // decode json
        $json = file_get_contents('http://localhost/phpprojects/news-portal-rest-api/api/news/read.php');
        $data = json_decode($json, true);

        // array of news
        $news = array();

        for($i = 0; $i < count($data["records"]); $i++) {
            echo '<div class="card">';
                //echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $data["records"][$i]["picture"] ).
                    //'" alt="Card image cap" width="193" height="130" style="float:left;width:50%;height:100%;object-fit:cover;"/>';
                echo '<div class="card-body">';
                    echo '<h2 class="card-header"><a class="green-link" href="readNews.php?id='.$data["records"][$i]["id"].'&title='.
                        stripslashes($data["records"][$i]["title"]).'">'.stripslashes($data["records"][$i]["title"]).'</a></h2>';
                    echo '<p class="card-text mt-1">'.stripslashes($data["records"][$i]["short_description"]).'</p>';
                    echo '<span>published on '.$data["records"][$i]["date_added"].', by '.
                        stripslashes($data["records"][$i]["author"]).'</span>';
                echo '</div>';
            echo '</div>';
        }

        ?>

    </div>
</main>
<!--end of main-->