<?php

class ReservesModel extends BaseModel {

  public function get_reserves_all_data(){
    $i = 0;
    $data = [];
    try{
      $this->pdo->beginTransaction();
      $sql = "SELECT * FROM reserves";
      $stmh = $this->pdo->prepare($sql);
      $stmh->execute();
      while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
        foreach ($row as $key => $value) {
          $data[$i][$key] = $value;
        }
        $i++;
      }
    } catch (PDOException $Exception) {
        $this->pdo->rollBack();
        print "エラー：" . $Exception->getMessage();
    }
    return $data;
  }

  public function get_reserves_data_id($id){
      $data = [];
      try {
          $sql= "SELECT * FROM reserves WHERE number = :id";
          $stmh = $this->pdo->prepare($sql);
          $stmh->bindValue(':id', $id, PDO::PARAM_INT );
          $stmh->execute();
          $data = $stmh->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $Exception) {
          print "エラー：" . $Exception->getMessage();
      }
      return $data;
  }

  public function reserve($data){
    try{
      $this->pdo->beginTransaction();
      $sql = "INSERT INTO reserves (number, start_date, return_date, who)
      VALUES (:number, :start_date, :return_date, :who)";
      $stmh = $this->pdo->prepare($sql);
      $stmh->bindValue(':number',   $data['id'],   PDO::PARAM_INT );
      $stmh->bindValue(':start_date',   $data['start_date'],   PDO::PARAM_INT );
      $stmh->bindValue(':return_date',   $data['return_date'],   PDO::PARAM_INT );
      $stmh->bindValue(':who',   $data['who'],   PDO::PARAM_STR );
      $stmh->execute();
      $this->pdo->commit();

    } catch (PDOException $Exception) {
        $this->pdo->rollBack();
        print "エラー：" . $Exception->getMessage();
    }
  }

  // 特定の期間はスマホを予約できないようにするための日にち配列作成
  public function create_days($data){
    $days = [];
    while($days == $data['return_date']){
      $j = 0; //何日間
      $sec = 60 * 60 * 24; //1日
      //配列に'Ymd'のフォーマットで日付を挿入
      $days = date('Ymd',strtotime($data['start_date']) + ($sec * $j));
      $j++;
    }
  }

  //予約日がきたら貸出に自動で登録して予約情報から削除
  public function reserve_check(){
    $today = date("Ymd");
    $data = $this->get_reserves_all_data();
    for ($i=0; $i < count($data); $i++) {
      if(strtotime($today) >= strtotime($data[$i]['start_date'])){

        $loan_data['return_date'] = $data[$i]['return_date'];
        $loan_data['who'] = $data[$i]['who'];
        $loan_data['id'] = $data[$i]['number'];

        $MainModel = new MainModel();
        $MainModel->loaning($loan_data);
        $this->delete_reserve($data[$i]['id']);
      }
    }
  }

  public function delete_reserve($id){
    try {
        //$this->pdo->beginTransaction();
        $sql = "DELETE FROM reserves WHERE id = :id";
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

  public function cansel_reserve($id){
    try {
      $this->pdo->beginTransaction();
      $sql = "DELETE FROM reserves WHERE id = :id";
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

  public function isTimeDuplication($startTime1, $endTime1, $startTime2, $endTime2) {
    return ($startTime1 <= $endTime2 && $startTime2 <= $endTime1);
  }


  public function get_reserves_list($id){
      $sql = <<<EOS
      SELECT

        reserves.id AS id,
        smartphone.id AS smartid,
        smartphone.name,
        reserves.start_date,
        reserves.return_date,
        reserves.who
      FROM
        reserves INNER JOIN smartphone
      ON
        reserves.number = smartphone.id
      WHERE
        reserves.number = :id
EOS;


      try {
          $stmh = $this->pdo->prepare($sql);
          $stmh->bindValue(':id',  $id, PDO::PARAM_INT );
          $stmh->execute();
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
      return [$data, $i];
  }
}
?>
