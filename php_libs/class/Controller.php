<?php
  class Controller
  {
    protected $type;
    protected $action;
    protected $next_type;
    protected $next_action;
    protected $file;
    protected $form;
    protected $renderer;
    protected $auth;
    protected $is_system = false;
    protected $view;
    protected $title;
    protected $message;
    protected $auth_error_mess;
    protected $login_state;

    private $debug_str;



    public function __construct($flag=false){
        $this->set_system($flag);
        // VIEWの準備
        $this->view_initialize();
    }

    public function set_system($flag){
        $this->is_system = $flag;
    }

    private function view_initialize(){
      $this->view = new Smarty();

      $this->view->template_dir = _SMARTY_TEMPLATES_DIR;
      $this->view->compile_dir = _SMARTY_TEMPLATES_C_DIR;
      $this->view->config_dir   = _SMARTY_CONFIG_DIR;
      $this->view->cache_dir    = _SMARTY_CACHE_DIR;

      // 入力チェック用クラス
      $this->form = new HTML_QuickForm2('Form');
      HTML_QuickForm2_Renderer::register('smarty','HTML_QuickForm2_Renderer_Smarty');
      $this->renderer  = HTML_QuickForm2_Renderer::factory('smarty');
      $this->renderer->setOption('old_compat', true);
      $this->renderer->setOption('group_errors', false);

      // リクエスト変数 typeとactionで動作を決めます。
      if(isset($_REQUEST['type'])){   $this->type   = $_REQUEST['type'];}
      if(isset($_REQUEST['action'])){ $this->action = $_REQUEST['action'];}

        // 共通の変数
      $this->view->assign('is_system',   $this->is_system );
      $this->view->assign('SCRIPT_NAME', _SCRIPT_NAME);
      $this->view->assign('add_pageID',  $this->add_pageID());
    }

    protected function view_display(){
        // セッション変数などの内容の表示
        $this->debug_display();


        // ログイン状況の表示
        //$this->disp_login_state();

        $this->view->assign('title', $this->title);
        $this->view->assign('auth_error_mess', $this->auth_error_mess);
        $this->view->assign('message', $this->message);
        //$this->view->assign('disp_login_state', $this->login_state);
        $this->view->assign('type',    $this->next_type);
        $this->view->assign('action',  $this->next_action);
        $this->view->assign('debug_str', $this->debug_str);

        $this->view->assign('form', $this->form->render($this->renderer)->toArray());
        $this->view->display($this->file);

        // デバッグ用
        //echo "<b>toArray()</b><pre>";var_dump($this->renderer->toArray());echo "</pre>";
        //print "<hr>";
        //echo "<b>form</b><pre>";var_dump($this->form);echo "</pre>";

    }
    public function debug_display(){
        if(_DEBUG_MODE){
            $this->debug_str = "";
            if(isset($_SESSION)){
                $this->debug_str .= '<br><br>$_SESSION<br>';
                $this->debug_str .= var_export($_SESSION, TRUE);
            }
            if(isset($_POST)){
                $this->debug_str .= '<br><br>$_POST<br>';
                $this->debug_str .= var_export($_POST, TRUE);
            }
            if(isset($_GET)){
                $this->debug_str .= '<br><br>$_GET<br>';
                $this->debug_str .= var_export($_GET, TRUE);
            }
            // smartyのデバッグモード設定 ポップアップウィンドウにテンプレート内の変数を
            // 表示します。
            $this->view->debugging = _DEBUG_MODE;
        }
    }

    public function add_pageID(){
        if( !($this->is_system && $this->type == 'list') ){ return;}

        $add_pageID = "";
        if(isset($_GET['pageID']) && $_GET['pageID'] != ""){
            $add_pageID = '&pageID=' . $_GET['pageID'];
            $_SESSION['pageID'] = $_GET['pageID'];
        }else if(isset($_SESSION['pageID']) && $_SESSION['pageID'] != ""){
            $add_pageID = '&pageID=' . $_SESSION['pageID'];
        }
        return $add_pageID;
    }


    public function make_form_controle(){
        $MemberModel = new MemberModel();
        $member_array = $MemberModel->get_member_data();;

        $options = [
          'format' => 'Ymd',
          'minYear' => date("Y"),
          'maxYear' => date("Y")+1,
        ];

        $who = $this->form->addElement('select', 'who', null, ['label' => 'slack名', 'options' => $member_array]);
        $start = $this->form->addElement('date', 'start_date', null, ['label' => '借用開始日'] + $options);
        $finish = $this->form->addElement('date', 'return_date', null, ['label' => '返却日'] + $options);

        $name =  $this->form->addElement('text',  'name',  ['size' => 30], ['label' => 'Slack名'] );

        $smartname =  $this->form->addElement('text',  'smartname',  ['size' => 30], ['label' => '名称'] );
        $asset_number =  $this->form->addElement('text',  'asset_number',  ['size' => 8], ['label' => ' 資産番号'] );


        $this->form->addRecursiveFilter('trim');

    }

    //----------------------------------------------------
    // ページ分割処理
    //----------------------------------------------------
    public function make_page_link($data){
        // Slindingを使用する場合
        //require_once('Pager/Sliding.php');

        // Jumpingを使用する場合
        require_once('Pager/Jumping.php');

        $params = [
            'mode'      => 'Jumping',
            'perPage'   => 10,
            'delta'     => 10,
            'itemData'  => $data
        ];

        // Slindingを使用する場合
        //$pager = new Pager_Sliding($params);

        // Jumpingを使用する場合
        $pager = new Pager_Jumping($params);

        $data  = $pager->getPageData();
        $links = $pager->getLinks();
        return [$data, $links];
    }
  }
?>
