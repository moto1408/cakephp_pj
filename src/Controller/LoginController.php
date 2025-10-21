<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * Login Controller
 * 認証（ログイン・ログアウト）処理を管理します。
 */
class LoginController extends AppController
{
    /**
     * 初期化メソッド。
     * 認証コンポーネントをロードします。
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        // 認証プラグインをロード
        $this->loadComponent('Authentication.Authentication');
    }
    
    /**
     * ログインページでは認証をスキップする設定。
     *
     * @param \Cake\Event\EventInterface $event The beforeFilter event.
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(EventInterface $event): ?Response
    {
        parent::beforeFilter($event);
        // ログイン画面 (index) とログアウト (logout) は認証なしでアクセス可能にする
        $this->Authentication->allowUnauthenticated(['index', 'logout']);
        
        return null;
    }

    /**
     * ログイン処理
     *
     * フォーム送信を受け取り、認証処理を実行します。
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // POSTリクエスト以外を弾く（セキュリティ上の推奨）
        $this->request->allowMethod(['get', 'post']);
        
        // 認証コンポーネントから認証結果を取得
        $result = $this->Authentication->getResult();
        
        // 1. 既にログインしている場合、または認証に成功した場合
        if ($result->isValid()) {
            // 認証後のリダイレクト先を取得 (config/app_authentication.phpで設定されるか、デフォルトは /)
            $target = $this->Authentication->getRedirectUrl(['controller' => 'Users', 'action' => 'index']);
            
            // ログイン成功メッセージ
            $this->Flash->success(__('ログインしました。'));

            return $this->redirect($target);
        }

        // 2. フォームがPOST送信され、認証に失敗した場合
        if ($this->request->is('post') && !$result->isValid()) {
            // 認証失敗メッセージ
            $this->Flash->error(__('メールアドレスまたはパスワードが不正です。'));
        }

        // ログイン画面のテンプレート（templates/Login/index.php）を表示
    }

    /**
     * ログアウト処理
     *
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        
        // ログイン中の場合のみログアウト処理を行う
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('ログアウトしました。'));
        }
        
        // ログインページへリダイレクト
        return $this->redirect(['controller' => 'Login', 'action' => 'index']);
    }
}