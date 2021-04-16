<?php
    include '../utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $threadId = $_GET['id'];
        
        $username =  $_SESSION['username'];
        $str = "SELECT extractUserId('$username') as id";
        $result=ExecuteQuery($str);
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];

        if($_POST['vote'] == 'Upvote'){

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
        }else if ($_POST['vote'] == 'Downvote'){
            
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

        }else if ($_POST['vote'] == 'Up'){


            $commentId = $_POST['commentId'];
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
            $commentId = $_POST['commentId'];
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
        
        
        
    }
?>
