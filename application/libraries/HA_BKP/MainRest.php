<?php
$empty = "";
$base_data = $this->security->xss_clean($this->input->raw_input_stream);

if(!is_null($base_data))
{
    $this->input->raw_input_stream = "";
    $headers = apache_request_headers();

    //log_message('error', print_r($headers, TRUE));
    //log_message('error', print_r($base_data, TRUE));
    //log_message('error', print_r($_SERVER, TRUE));
    if(isset($_SERVER['HTTP_REFERER']) && isset($headers['Content-Type']))
    {
        $this->shref = $_SERVER['HTTP_REFERER'];
        $this->ha_content_type = $headers['Content-Type'];
        $this->true_href = $this->baseauth->checkHttpReferer($this->shref);

        if($this->true_href==true && $this->ha_content_type==$this->baseauth->appjson)
        {
            $this->_key_rest($base_data,$this->ha_content_type);
            exit;
        }
        else
        {
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }
    }
    else if(isset($headers['Authorization']) && isset($headers['Content-Type']))
    {
        $this->ha_content_type = $headers['Content-Type'];
        $this->ha_authorization = $headers['Authorization'];
        $ha_array = explode('=',$this->ha_authorization);
        $where = array($this->tkn->MA_TKN => $ha_array[1],$this->tkn->TNAME => $ha_array[0],$this->tkn->TSTATUS => ACTIVESTS);
        //$where = array($this->tkn->MA_TKN => $this->ha_authorization,$this->tkn->TSTATUS => ACTIVESTS);
        $true_auth = $this->baseauth->checkAuthorization($this->tkn->tbl_name,$where);
        if($this->ha_content_type==$this->baseauth->appjson && $true_auth==true)
        {
            $this->_key_rest($base_data,$this->ha_content_type);
            exit;
        }
        else
        {
            header("HTTP/1.1 401 Unauthorized");
            echo $empty;
            exit;
        }
    }
    else
    {
        header("HTTP/1.1 401 Unauthorized");
        echo $empty;
        exit;
    }
}
else
{
    header("HTTP/1.0 404 Not Found");
    echo $empty;
    exit;
}
?>