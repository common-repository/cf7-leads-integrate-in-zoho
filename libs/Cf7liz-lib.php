<?php 
class Cf7liz_Lib{
	
	/**	
	 * @ public fucntion to send data to zoho crm
	 * @ param auth,company,name,email accepts varchar
	 * @ param mobile accept double
	 * @ return bool
	**/
	
    public function cf7liz_postData($auth, $company, $name, $email, $mobile, $message)
    {
        $xml = '<Leads><row no=""><FL val="Company">'.$company.'</FL><FL val="Last Name">'.$name.'</FL><FL val="Email">'.$email.'</FL><FL val="Mobile">'.$mobile.'</FL><FL val="Description">'.$message.'</FL></row></Leads>';
        $weburl ="https://crm.zoho.com/crm/private/xml/Leads/insertRecords";
        $qstring="authtoken=".$auth."&scope=crmapi&xmlData=";
        $newurl = $weburl.'?'.$qstring.$xml;
        $response = wp_remote_post( $newurl );
        return $response;
    }
}