<?php


namespace Tests\Traits;



use Illuminate\Testing\TestResponse;
use Illuminate\Validation\ValidationException;

trait WithApi
{

    /**
     * @param string $route
     * @param array $headers
     * @return TestResponse
     */
    protected function getApi(string $route, array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
        ]);
        return $this->get("/api$route", $headers);
    }

    /**
     * @param string $route
     * @param array $body
     * @param array $headers
     * @return TestResponse
     * @throws ValidationException
     */
    protected function postApi(string $route, array $body = [], array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        try {
            return $this->post("/api$route", $body, $headers);
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $route
     * @param array $body
     * @param array $headers
     * @return TestResponse
     */
    protected function putApi(string $route, array $body = [], array $headers = [], string $prefix = '/api'): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        return $this->put($prefix . $route, $body, $headers);
    }

    /**
     * @param string $route
     * @param array $body
     * @param array $headers
     * @return TestResponse
     */
    protected function patchApi(string $route, array $body = [], array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        try {
            $response = $this->patch("/api$route", $body, $headers);
            return $response;
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $route
     * @return mixed
     */
    protected function deleteApi(string $route, array $data = []): TestResponse
    {
        $headers =[
            'Accept'=>'application/json'
        ];
        return $this->delete("/api$route", $data,$headers);
    }

    public function login(array $attributes = []): TestResponse
    {
        return $this->postApi('/user/login', $attributes);
    }

    public function register(array $attributes = []): TestResponse
    {
        return $this->postApi('/user/register', $attributes);
    }

    public function logout(): TestResponse
    {
        return $this->postApi('/user/logout');
    }

}
