<?php

class MainModel extends BaseModel {

    //----------------------------------------------------
    // 会員情報をユーザー名で検索
    //----------------------------------------------------
    public function get_authinfo($username){
        $data = [];
        try {
            $sql= "SELECT * FROM user WHERE username = :username limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username',  $username,  PDO::PARAM_STR );
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }



    //----------------------------------------------------
    // 会員情報をユーザーIDで検索
    //----------------------------------------------------
    public function get_smartphone_data_id($id){
        $data = [];
        try {
            $sql= "SELECT * FROM smartphone WHERE id = :id limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT );
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    public function modify_member($userdata){
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  user
                      SET
                        username   = :username,
                        password   = :password
                      WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username',   $userdata['username'],   PDO::PARAM_STR );
            $stmh->bindValue(':password',   $userdata['password'],   PDO::PARAM_STR );
            $stmh->bindValue(':id',         $userdata['id'],         PDO::PARAM_INT );
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    // スマホ一覧の獲得
    public function get_smartphone_list($search_key){
        $sql = <<<EOS
SELECT * FROM smartphone
EOS;
        if($search_key != ""){
            $sql .= " WHERE name LIKE :name ";
        }

        try {
            $stmh = $this->pdo->prepare($sql);
            if($search_key != ""){
                $search_key = '%' . $search_key . '%';
                $stmh->bindValue(':name',  $search_key, PDO::PARAM_STR );
            }
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            $i=0;
            $data = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)){
                foreach( $row as $key => $value){
                        $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data, $count];
    }

    public function loaning($data){
      try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  smartphone
                      SET
                        reservation = :reservation,
                        return_date = :return_date,
                        who = :who
                      WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':reservation',   "貸出中",   PDO::PARAM_STR );
            $stmh->bindValue(':return_date',   $data['return_date'],   PDO::PARAM_STR );
            $stmh->bindValue(':who',   $data['who'],   PDO::PARAM_STR );
            $stmh->bindValue(':id',         $data['id'],         PDO::PARAM_INT );
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    public function regist_smartphone($data){
      try {
          $this->pdo->beginTransaction();
          $sql = "INSERT  INTO smartphone (asset_number, name, reservation, return_date, who) VALUES (:asset_number, :name, '貸出可', null, null)";
          $stmh = $this->pdo->prepare($sql);
          $stmh->bindValue(':asset_number',   $data['asset_number'],   PDO::PARAM_STR );
          $stmh->bindValue(':name',   $data['smartname'],   PDO::PARAM_STR );
          $stmh->execute();
          $this->pdo->commit();
      } catch (PDOException $Exception) {
          $this->pdo->rollBack();
          print "エラー：" . $Exception->getMessage();
      }
    }

    public function modify_smartphone($userdata){
      try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  smartphone
                      SET
                        asset_number   = :asset_number,
                        name   = :name
                      WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':name',   $userdata['smartname'],   PDO::PARAM_STR );
            $stmh->bindValue(':asset_number',   $userdata['asset_number'],   PDO::PARAM_STR );
            $stmh->bindValue(':id',         $userdata['id'],         PDO::PARAM_INT );
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    public function delete_member($id){
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM member WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT );
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    public function return($id){
      try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  smartphone
                      SET
                        reservation = :reservation,
                        return_date = :return_date,
                        who = :who
                      WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':reservation',   "貸出可",   PDO::PARAM_STR );
            $stmh->bindValue(':return_date',   null,   PDO::PARAM_STR );
            $stmh->bindValue(':who',   null,   PDO::PARAM_STR );
            $stmh->bindValue(':id',         $id,         PDO::PARAM_INT );
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


}
