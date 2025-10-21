<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user // Userエンティティは使用しないが、Auth設定に基づきnullを渡す
 */

// テンプレートのタイトルを設定 (レイアウトファイルで使用されます)
$this->assign('title', 'ユーザーログイン');
?>

<!-- 
    モバイルフレンドリーなデザイン調整:
    - 画面幅全体(w-100)を使用し、最大幅を小さく設定(max-width: 400px)。
    - スマートフォンでは左右の余白を小さくすることで、入力エリアを広く確保。
-->
<div class="row justify-content-center mx-1 mx-sm-auto mt-5" style="max-width: 400px;">
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white text-center rounded-top-3 p-3">
                <h4 class="mb-0">ログイン</h4>
            </div>
            <div class="card-body p-4">
                <p class="text-center text-muted small">メールアドレスとパスワードを入力してください。</p>
                
                <?= $this->Form->create(null, [
                    'url' => ['controller' => 'Login', 'action' => 'index'],
                    'class' => 'needs-validation', // HTML5バリデーションを使用
                    'novalidate' // バリデーションを一時的に無効にする場合は削除
                ]) ?>

                <fieldset>
                    <div class="form-group mb-3">
                        <!-- 'label'オプションでクラスを追加し、タッチしやすいように調整 -->
                        <?= $this->Form->control('email', [
                            'label' => ['text' => 'メールアドレス', 'class' => 'form-label fw-bold'],
                            'type' => 'email',
                            'class' => 'form-control form-control-lg', // スマホで入力しやすいように大きく
                            'required' => true,
                            'placeholder' => 'your@example.com',
                            'autofocus' => true,
                            'autocomplete' => 'email'
                        ]) ?>
                    </div>
                    
                    <div class="form-group mb-4">
                        <?= $this->Form->control('password', [
                            'label' => ['text' => 'パスワード', 'class' => 'form-label fw-bold'],
                            'type' => 'password',
                            'class' => 'form-control form-control-lg', // スマホで入力しやすいように大きく
                            'required' => true,
                            'autocomplete' => 'current-password'
                        ]) ?>
                    </div>
                    
                    <?= $this->Form->submit('ログイン', [
                        'class' => 'btn btn-primary btn-lg btn-block w-100 rounded-pill mt-3 mb-3' // 目立つボタンに
                    ]) ?>
                </fieldset>
                
                <?= $this->Form->end() ?>
            </div>
            <div class="card-footer text-center bg-light border-top p-3">
                <?= $this->Html->link('パスワードを忘れた場合', 
                    ['controller' => 'Users', 'action' => 'forgotPassword'], 
                    ['class' => 'text-muted small text-decoration-none']) 
                ?>
            </div>
        </div>
    </div>
</div>