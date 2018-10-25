<?php

class MemberModel extends BaseModel {

  public function get_member_data(){
      $member_array = [];
      try {
          $sql= "SELECT * FROM member  ";
          $stmh = $this->pdo->query($sql);
          while ($row = $stmh->fetch(PDO::FETCH_ASSOC)){
              $member_array[$row['id']] = $row['name'];
          }
      } catch (PDOException $Exception) {
          print "エラー：" . $Exception->getMessage();
      }
      return $member_array;
  }
  public function get_name_id($id){
    $name = "";
    try {
      $sql = "SELECT name FROM member WHERE id = :id";
      $stmh = $this->pdo->prepare($sql);
      $stmh->bindValue(':id', $id, PDO::FETCH_ASSOC);
      $stmh->execute();
      $name = $stmh->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $Exception) {
      print "エラー：".$Exception->getMessage();
    }
    return $name;
  }

  public function get_member_list($search_key){
        $sql = <<<EOS
SELECT
        id,
        name
FROM
        member
EOS;
        if($search_key != ""){
            $sql .= " AND ( name  like :name) ";
        }

        try {
            $stmh = $this->pdo->prepare($sql);
            if($search_key != ""){
                $search_key = '%' . $search_key . '%';
                $stmh->bindValue(':name', $search_key, PDO::PARAM_STR );
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

}
