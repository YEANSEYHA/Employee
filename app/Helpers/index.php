<?php
/**
 * @ Author: Phearum
 * @ Create Time: 2021-05-13 15:55:12
 * @ Modified by: Phearum
 * @ Modified time: 2021-05-19 22:50:08
 * @ Description: Create a template file
 */

function imgExtension()
{
    return ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
}

function success($data, $code = 200)
{
    $type = 'application/json';
    switch ($code) {
        case 200:
            $message = 'OK';
            break;
        case 201:
            $message = 'Created';
            break;
        case 202:
            $message = 'Updated';
            break;
        case 203:
            $message = 'Non-Authoritative Information';
            break;
        case 204:
            $message = 'No Content';
            break;
        default:
            $message = 'OK';
            break;
    }
    $header = [
        'Content-Type' => $type,
        'Message' => $message,
    ];
    return response()->json($data, $code)->withHeaders($header);
}

function notFound($data, $code = 400)
{
    $type = 'application/json';
    switch ($code) {
        case 400:
            $message = 'Bad Request';
            break;
        case 401:
            $message = 'Unauthorized';
            break;
        case 402:
            $message = 'Updated';
            break;
        case 403:
            $message = 'Forbidden';
            break;
        case 404:
            $message = 'Not Found';
            break;
        case 404:
            $message = 'Conflict';
            break;
        default:
            $message = 'Bad Request';
            break;
    }
    $header = [
        'Content-Type' => $type,
        'Message' => $message,
    ];
    return response()->json($data, $code)->withHeaders($header);
}

function error($data, $code = 500)
{
    $type = 'application/json';
    switch ($code) {
        case 500:
            $message = 'Internal Server Error';
            break;
        case 501:
            $message = 'Not Implemented';
            break;
        case 502:
            $message = 'Bad Getway';
            break;
        case 503:
            $message = 'Services Unavilable';
            break;
        case 504:
            $message = 'Getway Timeout';
            break;
        case 599:
            $message = 'Network Timeout';
            break;
        default:
            $message = 'nternal Server Error';
            break;
    }
    $header = [
        'Content-Type' => $type,
        'Message' => $message,
    ];
    return response()->json($data, $code)->withHeaders($header);
}

function success_create($data, $code = 201)
{
    return response()->json($data, $code);
}

function success_update($data, $code = 202)
{
    return response()->json($data, $code);
}

function success_delete($data, $code = 202)
{
    return response()->json($data, $code);
}

// function error($data = 'Missing fill', $code = 400)
// {
//     return response()->json($data, $code);
// }

function error_validate($data, $code = 403)
{
    return response()->json($data, $code);
}

function error_notFound($code = 404)
{
    return response()->json([
        'code' => $code,
        'message' => 'Error, Record not found',
    ]);
}

function Models()
{
    $models = [
        'users', 'roles', 'permissions',
    ];
    return $models;
}
function deleted($data, $code = 200)
{
    return response()->json($data, $code);
}
function created($data, $code = 202)
{
    return response()->json($data, $code);
}

/**
 * load
 *
 * @param  mixed $filename = 'datas-?'
 * @return void
 */
function loadJSON($filename = null, $path = '/../../database/datas/')
{
    $datas = [];
    if ($filename) {
        $filename = str_replace('datas-', '', $filename);
        $datas = json_decode(file_get_contents(__DIR__ . $path . $filename . '.json'));
        return count($datas) > 0 ? $datas : [];
    }
    return $datas;
}
function genSelect(array $select)
{
    $new_array = [];
    foreach ($select as $key => $list) {
        if (is_array($list)) {
            foreach ($list as $value) {
                if ($value === "*") {
                    $new_array[] = $key . ".*";
                } else {
                    $new_array[] = $key . "." . $value . " as " . ((substr($key, -1) === "s") ? substr($key, 0, -1) : $key) . "_" . $value;
                }
            }
        } else {
            $new_array[] = $list . ".*";
        }
    }
    return $new_array;
}
