<?php

/* function to return standard json response */
function jsonresponse($status, $message, $data = [])
{
    $response = [];
    $response['status'] = $status;
    $response['message'] = $message;
    $response['data'] = $data;
    return response()->json($response);
}

function questionsOperation($question)
{
    switch ($question) {
        case 'Cliente validou ?':
            return false;
            break;
        case 'Explicou o funcionamento do wi-fi?':
            return false;
            break;
        case 'Se foi informado o telefone do suporte técnico?':
            return false;
            break;
        case 'Qual foi a real reclamação?':
            return false;
            break;
        case 'Telefone de contato alternativo?':
            return false;
            break;
        case 'Verificar parâmetros do NGASP':
            return false;
            break;
        case 'Anexar dois anexos (01 obrigatório outro opcional)':
            return false;
            break;
        default:
            return true;
            break;
    }
}