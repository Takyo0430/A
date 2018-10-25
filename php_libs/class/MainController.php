<?php
  class MainController extends Controller {

    public function run(){
      $this->auth = new Auth();
      $this->auth->set_authname(_MEMBER_AUTHINFO);
      $this->auth->set_sessname(_MEMBER_SESSNAME);
      $this->auth->start();

     $ReservesModel = new ReservesModel();
     $ReservesModel->reserve_check();
      switch ($this->type) {
        case "reserve":
          $this->reserve();
          break;
        case "reserve_cansel":
          $ReservesModel = new ReservesModel();
          $ReservesModel->cansel_reserve($_GET['id']);
          $this->screen_list();
          break;
        case "loan":
          $this->screen_loan();
          //$this->screen();
          break;
        case "return":
          $this->return_smartphone();
          $this->screen();
          break;
        default:
          $this->screen_list();
      }

    }

    public function screen(){
      $this->screen_list();
    }


  private function screen_list(){
        $disp_search_key = "";
        $sql_search_key = "";
        // セッション変数の処理
        //unset($_SESSION[_MEMBER_AUTHINFO]);
        if(isset($_POST['search_key']) && $_POST['search_key'] != ""){
            //unset($_SESSION['pageID']);
            $_SESSION['search_key'] = $_POST['search_key'];
            $disp_search_key = htmlspecialchars($_POST['search_key'], ENT_QUOTES);
            $sql_search_key = $_POST['search_key'];
        }else{
            if(isset($_POST['submit']) && $_POST['submit'] == "検索する"){
                unset($_SESSION['search_key']);
            }else{
                if(isset($_SESSION['search_key'])){
                    $disp_search_key = htmlspecialchars($_SESSION['search_key'], ENT_QUOTES);
                    $sql_search_key = $_SESSION['search_key'];
                }
            }
        }
         // データベースを操作します。
        $MainModel = new MainModel();
        list($data, $count) = $MainModel->get_smartphone_list($sql_search_key);
        list($data, $links) = $this->make_page_link($data);

        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('search_key', $disp_search_key);
        $this->view->assign('links', $links['all']);
        $this->title = '一覧画面';
        $this->file = 'list.tpl';
        $this->view_display();
    }

    private function reserve() {
      $btn = "";
      $btn2 = "";
      $this->file = "reserve.tpl";
      $today = date("Y-m-d");

      $ReservesModel = new ReservesModel();
      $MainModel = new MainModel();

      //スマホテーブルの指定idの情報取得
      if ($this->action == "form") {
        $_SESSION[_MEMBER_AUTHINFO] = $MainModel->get_smartphone_data_id($_GET['id']);
      }
      list($data, $count) = $ReservesModel->get_reserves_list($_SESSION[_MEMBER_AUTHINFO]['id']);
      list($data, $links) = $this->make_page_link($data);

      $this->make_form_controle();

      if (!$this->form->validate()) {
          $this->action = "form";
      }
      if($this->action == "form"){
        $this->title = '予約登録';
        $this->next_type = 'reserve';
        $this->next_action = 'complete';
        $btn = "借りる";
      } /*else {
          if($this->action == 'confirm'){
            $this->title = '確認画面';
            $this->next_type = 'reserve';
            $this->next_action = 'complete';
            $this->form->toggleFrozen(true);
            $btn = '借りる';
            $btn2 = '戻る';
          } if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
              $this->title = '予約登録';
              $this->next_type = 'reserve';
              $this->next_action = 'confirm';
              $btn = '確認画面へ';
            }*/
        else {
          $data = $this->form->getValue();
          $isTime = false;

          //入力された予約期間
          $data['start_date'] = sprintf("%04d%02d%02d",
              $data['start_date']['Y'],
              $data['start_date']['m'],
              $data['start_date']['d']);
          $data['return_date'] = sprintf("%04d%02d%02d",
              $data['return_date']['Y'],
              $data['return_date']['m'],
              $data['return_date']['d']);
          $startTime1 = strtotime($data['start_date']);
          $endTime1 = strtotime($data['return_date']);

        //予約と予約で検証
          $reservesdata[] = $ReservesModel->get_reserves_data_id($_SESSION[_MEMBER_AUTHINFO]['id']);
          foreach ($reservesdata as $key) {
            $startTime2 = strtotime($key['start_date']);
            $endTime2 = strtotime($key['return_date']);
            $isTime = $ReservesModel->isTimeDuplication($startTime1, $endTime1, $startTime2, $endTime2);
          }

        //貸出期間が決まっている時に予約がされた場合
          //今現在からの登録された貸出期間
          if (!$isTime) {
            $startTime2 = strtotime('now');
            $endTime2 = strtotime($_SESSION[_MEMBER_AUTHINFO]['return_date']);
            $isTime = $ReservesModel->isTimeDuplication($startTime1, $endTime1, $startTime2, $endTime2);
          }

          if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '借りる' &&
              !$isTime) {

                $data['id'] = $_SESSION[_MEMBER_AUTHINFO]['id'];
                $this->title = '予約完了';
                $MemberModel = new MemberModel();
                $name = $MemberModel->get_name_id($data['who']);
                $data['who'] = $name['name'];

                $ReservesModel->reserve($data);
                $this->message = "貸出を開始します。"."期限までに返しましょう。";
                $this->file = "message.tpl";

                //カレンダー登録処理
                $smartphone = $MainModel->get_smartphone_data_id($data['id']);
                $Regist = new RegistCalendar();
                $summary = "";
                $Regist->writeGoogleCalendar($data['start_date'], $data['return_date'], $smartphone['name'], $data['who']);

              } else {
                $this->title="予約エラー";
                $this->message = "予約期間が重複しています。";
                $this->file = "message.tpl";
              }
            }
          //}
        $this->form->addElement('submit', 'submit', ['value' =>$btn]);
        $this->form->addElement('submit', 'submit2', ['value' =>$btn2]);
        $this->form->addElement('reset', 'reset', ['value' =>'取り消し']);

        $this->view->assign('today', $today);
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('links', $links['all']);
        $this->view_display();
    }

    private function screen_loan() {
      $btn = "";
      $btn2 = "";
      $this->file = "loan_form.tpl";
      $today = date("Y-m-d");

      $MainModel = new MainModel();
      if ($this->action == "form") {
            $_SESSION[_MEMBER_AUTHINFO] = $MainModel->get_smartphone_data_id($_GET['id']);
        }

        $this->make_form_controle();

        if (!$this->form->validate()) {
            $this->action = "form";
        }

        if($this->action == "form"){
          $this->title = '貸出登録';
          $this->next_type = 'loan';
          $this->next_action = 'complete';
          $btn = "借りる";
        /*確認処理の実装
      } else {
          if($this->action == 'confirm'){
            $this->title = '確認画面';
            $this->next_type = 'loan';
            $this->next_action = 'complete';
            $this->form->toggleFrozen(true);
            $btn = '借りる';
            $btn2 = '戻る';
          } if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
              $this->title = '貸出登録';
              $this->next_type = 'loan';
              $this->next_action = 'confirm';
              $btn = '確認画面へ';*/
            } else {
              $data = $this->form->getValue();
              $data['return_date'] = sprintf("%04d%02d%02d",
                  $data['return_date']['Y'],
                  $data['return_date']['m'],
                  $data['return_date']['d']);

              //貸出の期間
              $startTime1 = strtotime('now');
              $endTime1 = strtotime($data['return_date']);

              //予約の期間
              $ReservesModel = new ReservesModel();
              $reservesdata[] = $ReservesModel->get_reserves_data_id($_SESSION[_MEMBER_AUTHINFO]['id']);
              $isTime = false;
              foreach ($reservesdata as $key) {
                $startTime2 = strtotime($key['start_date']);
                $endTime2 = strtotime($key['return_date']);
                $isTime = $ReservesModel->isTimeDuplication($startTime1, $endTime1, $startTime2, $endTime2);
              }

              if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '借りる' && !$isTime) {
                $data['id'] = $_SESSION[_MEMBER_AUTHINFO]['id'];
                $MemberModel = new MemberModel();
                $name = $MemberModel->get_name_id($data['who']);
                $data['who'] = $name['name'];
                $this->title = '貸出完了';
                $MainModel->loaning($data);
                $this->message = "貸出を開始します。期限までに返しましょう。";
                $this->file = "message.tpl";
                //カレンダー登録処理
                $smartphone = $MainModel->get_smartphone_data_id($data['id']);
                $startDay  = date('Y-m-d');
                $Regist = new RegistCalendar();
                $summary = "";
                $Regist->writeGoogleCalendar($startDay, $data['return_date'], $smartphone['name'], $data['who']);

              }else {
                $this->title="貸出エラー";
                $this->message = "貸出期間が予約と重複しています。";
                $this->file = "message.tpl";
              }
            }
          //}


        $this->view->assign('today', $today);
        $this->form->addElement('submit', 'submit', ['value' =>$btn]);
        $this->form->addElement('submit', 'submit2', ['value' =>$btn2]);
        $this->form->addElement('reset', 'reset', ['value' =>'取り消し']);
        $this->view_display();


      //$MainModel->loaning($_GET['id']);
    }

    private function return_smartphone() {
      $MainModel = new MainModel();
      $MainModel->return($_GET['id']);
    }

}
  ?>
