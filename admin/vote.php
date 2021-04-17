<?php
        include '../Pages/utility.php';
        // echo $_GET['vote'];
        // echo $_GET['id'];
        // echo  $_SESSION['username'];
        //  die();
        session_start();
        $username =  $_SESSION['username'];
        $str = "SELECT extractUserId('$username') as id";
        $result=ExecuteQuery($str);
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];

        if($_GET['vote'] == 'up'){

            $threadId = $_GET['id'];



            $sql = "SELECT * from votethread where userId = $userId and threadId = $threadId";
            $result = ExecuteQuery($sql);
            $noRows = mysqli_num_rows($result);
            if($noRows > 0){

                $str = "SELECT voteValue from votethread where userId = $userId and threadId = $threadId";
                $result=ExecuteQuery($str);
                $row = mysqli_fetch_assoc($result);

                $preVote = $row['voteValue'];

                if($preVote < 0){
                    $sql = "UPDATE votethread SET voteValue = 1 where  userId = $userId and threadId = $threadId";
                    $result = ExecuteQuery($sql);
                    $sql = "UPDATE threads SET votes = votes + 2 where  threadId = $threadId";
                    $result = ExecuteQuery($sql);
                }
                $sql = "UPDATE votethread SET voteValue = 1 where  userId = $userId and threadId = $threadId";
                $result = ExecuteQuery($sql);
            }else{
                $sql = "INSERT into votethread (userId,threadId,voteValue)"
                ."VALUES ($userId,$threadId,1)";
                $result = ExecuteQuery($sql);
                $sql = "UPDATE threads SET votes = votes + 1 where   threadId = $threadId";
                $result = ExecuteQuery($sql);
            }


            //echo "Upvote";
        }else if ($_GET['vote'] == 'down'){

            $threadId = $_GET['id'];
            
            $sql = "SELECT * from votethread where userId = $userId and threadId = $threadId";
            $result = ExecuteQuery($sql);
            $noRows = mysqli_num_rows($result);
            if($noRows > 0){

                $str = "SELECT voteValue from votethread where userId = $userId and threadId = $threadId";
                $result=ExecuteQuery($str);
                $row = mysqli_fetch_assoc($result);

                $preVote = $row['voteValue'];

                if($preVote > 0){
                    $sql = "UPDATE votethread SET voteValue = -1 where  userId = $userId and threadId = $threadId";
                    $result = ExecuteQuery($sql);
                    $sql = "UPDATE threads SET votes = votes - 2 where  threadId = $threadId";
                    $result = ExecuteQuery($sql);
                }
                $sql = "UPDATE votethread SET voteValue = -1 where  userId = $userId and threadId = $threadId";
                $result = ExecuteQuery($sql);
            }else{
                $sql = "INSERT into votethread (userId,threadId,voteValue)"
                ."VALUES ($userId,$threadId,-1)";
                $result = ExecuteQuery($sql);
                $sql = "UPDATE threads SET votes = votes - 1 where   threadId = $threadId";
                $result = ExecuteQuery($sql);
            }
            
        }else if ($_GET['vote'] == 'Up'){


            $commentId = $_GET['id'];
            // echo $commentId;
            // die();
            
            $sql = "SELECT * from votecomment where userId = $userId and commentId = $commentId";
            $result = ExecuteQuery($sql);
            $noRows = mysqli_num_rows($result);
            if($noRows > 0){

                $str = "SELECT voteValue from votecomment where userId = $userId and commentId = $commentId";
                $result=ExecuteQuery($str);
                $row = mysqli_fetch_assoc($result);

                $preVote = $row['voteValue'];

                if($preVote < 0){
                    $sql = "UPDATE votecomment SET voteValue = 1 where  userId = $userId and commentId = $commentId";
                    $result = ExecuteQuery($sql);
                    $sql = "UPDATE comments SET votes = votes + 2 where  commentId = $commentId";
                    $result = ExecuteQuery($sql);
                }
                $sql = "UPDATE votecomment SET voteValue = 1 where  userId = $userId and commentId = $commentId";
                $result = ExecuteQuery($sql);
            }else{
                $sql = "INSERT into votecomment (userId,commentId,voteValue)"
                ."VALUES ($userId,$commentId,1)";
                $result = ExecuteQuery($sql);
                $sql = "UPDATE comments SET votes = votes + 1 where   commentId = $commentId";
                $result = ExecuteQuery($sql);
            }

        }else{
            $commentId = $_GET['id'];
            // echo $commentId;
            // die();
            
            $sql = "SELECT * from votecomment where userId = $userId and commentId = $commentId";
            $result = ExecuteQuery($sql);
            $noRows = mysqli_num_rows($result);
            if($noRows > 0){

                $str = "SELECT voteValue from votecomment where userId = $userId and commentId = $commentId";
                $result=ExecuteQuery($str);
                $row = mysqli_fetch_assoc($result);

                $preVote = $row['voteValue'];

                if($preVote > 0){
                    $sql = "UPDATE votecomment SET voteValue = -1 where  userId = $userId and commentId = $commentId";
                    $result = ExecuteQuery($sql);
                    $sql = "UPDATE comments SET votes = votes - 2 where  commentId = $commentId";
                    $result = ExecuteQuery($sql);
                }
                $sql = "UPDATE votecomment SET voteValue = -1 where  userId = $userId and commentId = $commentId";
                $result = ExecuteQuery($sql);
            }else{
                $sql = "INSERT into votecomment (userId,commentId,voteValue)"
                ."VALUES ($userId,$commentId,-1)";
                $result = ExecuteQuery($sql);
                $sql = "UPDATE comments SET votes = votes - 1 where   commentId = $commentId";
                $result = ExecuteQuery($sql);
            }
        }

header("Location: {$_SERVER['HTTP_REFERER']}");

?>