<?php 

include ('../../Config/db_config.php');


    if(isset($_POST["fetchHall"])){
        $cinemaID=$_POST["fetchHall"];
        $query='SELECT * FROM hall WHERE hall_cinema_id='.$cinemaID.'';

        $res = mysqli_query($conn, $query);
        $hallList = mysqli_fetch_all($res, MYSQLI_ASSOC);
        print json_encode($hallList);

    }

    if(isset($_POST["fetchMovie"])){
    
        $query='SELECT * FROM movie';

        $res = mysqli_query($conn, $query);
        $movieList = mysqli_fetch_all($res, MYSQLI_ASSOC);
        print json_encode($movieList);

    }

    if(isset($_POST["hallID"], $_POST["movieID"], $_POST["date"])){
       
        $hallID=$_POST["hallID"];
        $movieID=$_POST["movieID"];
        $date=$_POST["date"];


        $query='SELECT * FROM aired WHERE movie_id= '.$movieID.' AND  hall_id='.$hallID.' AND aired_date="'.$date.'" ';
        $res = mysqli_query($conn, $query);
        $aired = mysqli_fetch_all($res, MYSQLI_ASSOC);


         print json_encode($aired);
        

    }
?>
