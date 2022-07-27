<?php

use App\Models\UserModel;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($authHeader)
{
  if (is_null($authHeader)) {
    throw new Exception('Authenticated failed!');
  }
  return explode(" ", $authHeader)[1];
}

function validateJWT($encodedToken)
{
  $key = getenv('JWT_SECRET_KEY');

  $decodeToken = JWT::decode($encodedToken, new Key($key, 'HS256'));

  $modaluser = new UserModel();

  $modaluser->getEmail($decodeToken->emailUser);
}

function createJWT($email)
{
  $timeReq = time();
  $timeToken = getenv('JWT_TIME_TO_LIVE');
  $timeExp = $timeReq + $timeToken;

  $payload = [
    'emailUser' => $email,
    'iat'   => $timeReq,
    'exp'   => $timeExp,
  ];
  $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
  return $jwt;
}
