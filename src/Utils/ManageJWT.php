<?php
    namespace GpiPoligran\Utils;
    use CommunityFutbolInterfaces\Utils\ManageJWT as IManageJWT;
    use \Firebase\JWT\JWT;
    use GpiPoligran\Utils\ManageGuid;

    final class ManageJWT {
        public static function create(array $payload,int $exp) : string{
            $iat = time();

            $data = array(
                'iat'  => $iat,
                'nbf'  => $iat,
                'exp'  => $iat + $exp,
                'jti'  => ManageGuid::generate(),
                'data' => $payload
            );

            return JWT::encode($data,$_ENV['JWT_KEY']);
        }

        public static function decode(string $token) : array{
            $rawDecode = JWT::decode($token,$_ENV['JWT_KEY'],array('HS256'));
            return array(
                'data' => $rawDecode->data,
                'jti'  => $rawDecode->jti
            );
        }
    }