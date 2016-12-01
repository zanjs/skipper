<?php


class LoginTest extends TestCase
{
    public function testSuccessfulLoginWithDefaultCredentials()
    {
        $this->visit(route('skipper.login'));
        $this->type('z@z.com', 'email');
        $this->type('password', 'password');
        $this->press('Login Logging in');
        $this->seePageIs(route('skipper.dashboard'));
    }

    public function testShowAnErrorMessageWhenITryToLoginWithWrongCredentials()
    {
        $this->visit(route('skipper.login'))
             ->type('john@Doe.com', 'email')
             ->type('pass', 'password')
             ->press('Login Logging in')
             ->seePageIs(route('skipper.login'))
             ->see('The given credentials don\'t match with an user registered.')
             ->seeInField('email', 'john@Doe.com');
    }
}
