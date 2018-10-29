<?php

namespace Tests\Feature;

use Tests\AbstractTestCase;

/**
 * Тесты на реализованный функционал
 *
 * Class FeatureTest
 * @package Tests\Feature
 */
class FeatureTest extends AbstractTestCase
{
    /**
     * Проверим ответ для неаутентифицированного пользователя
     * форма отправки сообщения не показана
     *
     * @return void
     */
    public function testNotAuthenticatedUserDoesNotSeeMessagePublishForm()
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertDontSee('publishNewMessageForm');
    }

    /**
     * Для аутентифицированного пользователя форма отправки сообщения
     * отображается
     */
    public function testAuthenticatedUserSeeMessagePublishForm()
    {
        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user)->get('/');

        $response
            ->assertOk()
            ->assertSee('publishNewMessageForm');
    }

    /**
     * Не аутентифицированный пользователь видит ссылки "Авторизация"
     * и "Регистрация"
     */
    public function testNotAuthenticatedUserSeesLoginAndRegisterMenuLinks()
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Авторизация')
            ->assertSee('Регистрация');
    }

    /**
     * Аутентифицированный пользователь видит ссылки "Выход" и свое имя
     */
    public function testAuthenticatedUserSeesLogoutAndHisLogin()
    {
        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertOk()
            ->assertSee('Выход')
            ->assertSee($user->name);
    }

    /**
     * Аутентифицированный пользователь отправил сообщение
     * и увидел его содрежимое в повторном запросе
     */
    public function testAuthenticatedUserSubmitNewMessageSeesSubmittedMessage()
    {

        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user)->post('/', ['content' => 'Test content']);

        $response->assertRedirect('/');

        $secondaryResponse = $this->get('/');

        $secondaryResponse
            ->assertOk()
            ->assertSee('Test content');
    }

    /**
     * При попыптке аутентифицированного пользователя отправить пустое сообщение
     * отображается сообщение об ошибке
     */
    public function testAuthenticatedUserSubmittedEmptyMessage()
    {
        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user)->post('/', ['content' => ' ']);

        $response->assertRedirect('/');

        $secondaryResponse = $this->get('/');

        $secondaryResponse
            ->assertOk()
            ->assertSeeText('Ошибка! Сообщение не может быть пустым.');
    }

    /**
     * Попытка логина с данными пользователя, которого нет в БД
     */
    public function testUnsuccessfulAuthenticationAttempt()
    {
        $response = $this->post('/login', ['name' => 'TestUser', 'password' => 'TestPassword']);

        $response
            ->assertRedirect()
            ->assertSessionHasErrors(['name']);
    }

    /**
     * Успешный логин от пользотеля, который присутствует в БД
     */
    public function testSuccessfulAuthenticationAttempt()
    {
        $user = factory(\App\Models\User::class)->create([
            'name' => 'TestUser',
            'password' => 'qwerty123'
        ]);

        $response = $this->post('/login', ['name' => 'TestUser', 'password' => 'qwerty123']);

        $response->assertRedirect('/');
    }

    /**
     * Попытка зарегистрироваться с некорректными данными
     */
    public function testUnsuccessfulRegisterAttempt()
    {
        $response = $this->post('/register', [
            'name' => 'user1',
            'password' => '123',
            'password_confirm' => '456'
        ]);

        $response
            ->assertRedirect()
            ->assertSessionHasErrors(['name', 'password']);
    }

    /**
     * Попытка зарегистрироваться с корректными данными
     */
    public function testSuccessfulRegisterAttempt()
    {
        $response = $this->post('/register', [
            'name' => 'superuser',
            'password' => 'Qwerty123',
            'password_confirm' => 'Qwerty123'
        ]);

        $response->assertRedirect();
    }
}
