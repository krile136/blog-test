<?php

namespace App\Traits;

use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;

trait CanManageForm
{
    /**
     *  保存先のキーの名前を返
     *
     * @param  string  $name
     * @return string
     */
    protected function getKeyName(string $name): string
    {
        $main_key = str_replace('\\', '_', get_class($this));
        $route = request()->route();
        $key_parameters = array_merge([$main_key], array_values($route->parameters()));

        return implode('_', $key_parameters).'.'.$name;
    }

    /**
     * フォームデータをクリア
     */
    public function clearFormData(): void
    {
        $this->setFormData([]);
    }

    /**
     * フォームデータを保存する
     *
     * @param  array  $input
     * @param  array  $excepts
     */
    public function setFormData(array $input, array $excepts = ['_token', 'workspace', 'author']): void
    {
        $input = Arr::except($input, $excepts);
        $key = $this->getKeyPrefix().'.'.$this->getKeyName('form');
        if (empty($input)) {
            $this->getStorage()->forget($key);
        } else {
            $this->getStorage()->put($key, json_encode($input));
        }
    }

    /**
     * フォームデータを保存する（マージ）
     * チェックボックスなど値が空になるとPOSTされてこないデータがあるが
     * この場合は$needsにキーを設定しておくとnullで上書きされる
     *
     * @param  array  $input
     * @param  array  $needs
     * @param  array  $excepts
     */
    public function mergeFormData(array $input, array $needs = [], array $excepts = ['_token', 'id', 'workspace', 'author']): void
    {
        $input = Arr::except($input, $excepts);
        $data = $this->getFormData();
        $this->setFormData(array_merge($data, array_fill_keys($needs, null), $input));
    }

    /**
     * フォームデータを取得
     * old()もマージしたデータを返す
     *
     * @return array
     */
    public function getFormData(): array
    {
        $key = $this->getKeyPrefix().'.'.$this->getKeyName('form');
        $data = (array) json_decode($this->getStorage()->get($key), true);
        $excepts = ['_token', 'id', 'workspace', 'author'];
        $old = Arr::except((array) request()->old(), $excepts);

        return array_merge($data, $old);
    }

    /**
     *  フォームのステップを定義
     *
     * @return void
     */
    public function initFormStep($steps): void
    {
        if (empty($steps)) {
            $key = $this->getKeyPrefix().'.'.$this->getKeyName('step');
            $this->getStorage()->forget($key);
        } else {
            $keys = (array) $steps;
            $values = array_fill(0, count($keys), false);
            $this->setFormData(array_combine($keys, $values));
        }
    }

    /**
     * フォームのステップ情報を保存
     *
     * @param  array  $data
     */
    public function setFormStep(array $data): void
    {
        $key = $this->getKeyPrefix().'.'.$this->getKeyName('step');
        $this->getStorage()->put($key, json_encode($data));
    }

    /**
     * フォームのステップ情報を取得
     *
     * @param  array  $data
     * @return array
     */
    public function getFormStep(): array
    {
        $key = $this->getKeyPrefix().'.'.$this->getKeyName('step');

        return (array) json_decode($this->getStorage()->get($key), true);
    }

    /**
     * 通過
     *
     * @param  string  $step
     */
    public function passStep(string $step): void
    {
        $check_list = $this->getFormStep();
        if (isset($check_list[$step])) {
            $check_list[$step] = true;
            $this->setFormStep($check_list);
        }
    }

    /**
     * 通過（複数）
     *
     * @param  array  $steps
     */
    public function passSteps(array $steps): void
    {
        foreach ($steps as $step) {
            $this->passStep($step);
        }
    }

    /**
     * 通過取り消し
     *
     * @param  string  $step
     */
    public function backStep(string $step): void
    {
        $check_list = $this->getFormStep();
        if (isset($check_list[$step])) {
            $check_list[$step] = false;
            $this->setFormStep($check_list);
        }
    }

    /**
     * 通過チェック
     * 指定したStepをすべて通過したかを判定
     * $steps=nullの場合は全ステップの通過をチェック
     */
    public function checkPassesStep($steps = null): bool
    {
        $check_list = $this->getFormStep();
        if ($steps === null) {
            $steps = (array) $steps;
            $check_list = array_intersect_key($check_list, array_combine($steps, $steps));
        }
        $count = count($check_list);
        if (! ($count > 0 && $count === count(array_filter($check_list)))) {
            logger()->warning('skipping step', compact('steps', 'check_list'));

            return false;
        }

        return true;
    }

    /**
     * フォームデータと通過データをクリア
     */
    public function clearForm(): void
    {
        $this->clearFormData();
        $this->initFormStep([]);
    }

    /**
     * @return Store|SessionManager
     */
    protected function getStorage(): Store|SessionManager
    {
        return session();
    }

    /**
     * @return string
     */
    protected function getKeyPrefix(): string
    {
        return config('app.name');
    }
}
