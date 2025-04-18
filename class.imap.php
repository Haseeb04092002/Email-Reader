<?php

$attachmentsStatus = []; // global array type variable

class Imap
{
    private $connection;

    // Connect to the IMAP server
    public function connect($host, $username, $password)
    {
        $this->connection = imap_open($host, $username, $password);
        if (!$this->connection) {
            die("Connection failed: " . imap_last_error());
        }
        return $this->connection;
    }

    public function DownloadAttachment($limit = "")
    {
        $inbox = $this->connection;
        // $StartMailNum = $limit;
        // $totalMails = imap_num_msg($this->connection);

        // $StartMailNum = $limit;
        $StartMailNum = 5;
        // $totalMails = imap_num_msg($this->connection);
        $totalMails = 10;

        for ($emailId = $totalMails; $emailId >= $StartMailNum; $emailId--) {
            $overview = imap_fetch_overview($inbox, $emailId, 0);
            $message = imap_fetchbody($inbox, $emailId, 2);

            $structure = imap_fetchstructure($inbox, $emailId);
            $attachments = [];

            /* if any attachments found... */
            if (isset($structure->parts) && count($structure->parts)) {
                for ($i = 0; $i < count($structure->parts); $i++) {
                    $attachments[$i] = [
                        "is_attachment" => false,
                        "filename" => "",
                        "name" => "",
                        "attachment" => "",
                    ];

                    if ($structure->parts[$i]->ifdparameters) {
                        foreach (
                            $structure->parts[$i]->dparameters
                            as $object
                        ) {
                            if (strtolower($object->attribute) == "filename") {
                                $attachments[$i]["is_attachment"] = true;
                                $attachments[$i]["filename"] = $object->value;
                            }
                        }
                    }

                    if ($structure->parts[$i]->ifparameters) {
                        foreach ($structure->parts[$i]->parameters as $object) {
                            if (strtolower($object->attribute) == "name") {
                                $attachments[$i]["is_attachment"] = true;
                                $attachments[$i]["name"] = $object->value;
                            }
                        }
                    }

                    if ($attachments[$i]["is_attachment"]) {
                        $attachments[$i]["attachment"] = imap_fetchbody(
                            $inbox,
                            $emailId,
                            $i + 1
                        );
                        /* 3 = BASE64 encoding */
                        if ($structure->parts[$i]->encoding == 3) {
                            $attachments[$i]["attachment"] = base64_decode(
                                $attachments[$i]["attachment"]
                            );
                        } /* 4 = QUOTED-PRINTABLE encoding */ elseif (
                            $structure->parts[$i]->encoding == 4
                        ) {
                            $attachments[$i][
                                "attachment"
                            ] = quoted_printable_decode(
                                $attachments[$i]["attachment"]
                            );
                        }
                    }
                }
            }

            /* iterate through each attachment and save it */
            foreach ($attachments as $attachment) {
                if ($attachment["is_attachment"] == 1) {
                    $filename = $attachment["name"];
                    if (empty($filename)) {
                        $filename = $attachment["filename"];
                    }

                    if (empty($filename)) {
                        $filename = time() . ".dat";
                    }
                    $folder = "attachment";
                    if (!is_dir($folder)) {
                        mkdir($folder);
                    }
                    $fp = fopen(
                        "./" . $folder . "/" . $emailId . "-" . $filename,
                        "w+"
                    );
                    fwrite($fp, $attachment["attachment"]);
                    fclose($fp);
                }
            }
        }
    }

    public function IsAttachment_old($limit = "")
    {
        // initializing variables
        $totalMails = "";
        $StartMailNum = "";
        $EndMailNum = "";
        $emailId = "";
        $totalMails = "";
        $totalMails = "";
        $totalMails = "";

        $overview = "";
        $structure = "";

        /* get mail structure */
        $attachments = [];
        $isAttachment = "";

        $StartMailNum = $limit; //250
        $totalMails = imap_num_msg($this->connection);
        // ----- checking if there is attachment
        for ($emailId = $totalMails; $emailId >= $StartMailNum; $emailId--) {
            // echo '<br>';
            // echo $emailId;

            $structure = imap_fetchstructure($this->connection, $emailId);

            /* if any attachments found... */
            if (isset($structure->parts) && count($structure->parts)) {
                for ($i = 0; $i < count($structure->parts); $i++) {
                    $attachments[$i] = [
                        "is_attachment" => false,
                        "filename" => "",
                        "name" => "",
                        "attachment" => "",
                    ];

                    if ($structure->parts[$i]->ifdparameters) {
                        foreach (
                            $structure->parts[$i]->dparameters
                            as $object
                        ) {
                            if (strtolower($object->attribute) == "filename") {
                                $attachments[$i]["is_attachment"] = true;
                                $attachments[$i]["filename"] = $object->value;
                            }
                        }
                    }

                    if ($structure->parts[$i]->ifparameters) {
                        foreach ($structure->parts[$i]->parameters as $object) {
                            if (strtolower($object->attribute) == "name") {
                                $attachments[$i]["is_attachment"] = true;
                                $attachments[$i]["name"] = $object->value;
                            }
                        }
                    }

                    if ($attachments[$i]["is_attachment"]) {
                        $isAttachment = $emailId;
                        $attachments[$i]["attachment"] = imap_fetchbody(
                            $this->connection,
                            $emailId,
                            $i + 1
                        );

                        /* 3 = BASE64 encoding */
                        if ($structure->parts[$i]->encoding == 3) {
                            $attachments[$i]["attachment"] = base64_decode(
                                $attachments[$i]["attachment"]
                            );
                        } /* 4 = QUOTED-PRINTABLE encoding */ elseif (
                            $structure->parts[$i]->encoding == 4
                        ) {
                            $attachments[$i][
                                "attachment"
                            ] = quoted_printable_decode(
                                $attachments[$i]["attachment"]
                            );
                        }
                    } else {
                        $isAttachment = $emailId;
                    }
                }
            }
        }

        return $isAttachment;
    }
    public function checkAttachmentsStatus($limit = "")
    {
        // $StartMailNum = $limit;
        // $StartMailNum = 5;
        $totalMails = imap_num_msg($this->connection);
        $EndMailNum = $totalMails-$limit;
        
        $hasAttachment = false;

        // Loop through emails in reverse (from newest to oldest)
        for ($emailId = $totalMails; $emailId >= $EndMailNum; $emailId--) {
            $structure = imap_fetchstructure($this->connection, $emailId);

            if (isset($structure->parts) && count($structure->parts)) {
                // Loop through each part of the email
                for ($i = 0; $i < count($structure->parts); $i++) {
                    if ($structure->parts[$i]->ifdparameters) {
                        foreach (
                            $structure->parts[$i]->dparameters
                            as $object
                        ) {
                            if (strtolower($object->attribute) == "filename") {
                                $hasAttachment = true;
                                break 2; // Exit both loops early if an attachment is found
                            }
                        }
                    }

                    if ($structure->parts[$i]->ifparameters) {
                        foreach ($structure->parts[$i]->parameters as $object) {
                            if (strtolower($object->attribute) == "name") {
                                $hasAttachment = true;
                                break 2;
                            }
                        }
                    }
                }
            }

            // $hasAttachment = false;
            $attachmentsStatus[$emailId] = $hasAttachment;
        }
        // $emailId = imap_num_msg($this->connection); // or use $limit directly
        // $hasAttachment = false;
        // $attachmentsStatus[$emailId] = $hasAttachment;
        return $attachmentsStatus;
    }

    public function LimitedMails($limit = "", $attachmentsStatus = [])
    {
        // initializing variables
        $totalMails = "";
        $StartMailNum = "";
        $EndMailNum = "";
        $emailId = "";
        $overview = "";
        $structure = "";
        $MailItems = [];

        $totalMails = imap_num_msg($this->connection);
        $EndMailNum = $totalMails-$limit;
        
        // Loop through emails in reverse (from newest to oldest)
        for ($emailId = $totalMails; $emailId >= $EndMailNum; $emailId--) {
            $overview = imap_fetch_overview($this->connection, $emailId, 0);
            // $body = imap_fetchbody($this->connection, $emailId, 1);

            $MailItems[] = [
                "subject" => $overview[0]->subject,
                "from" => $overview[0]->from,
                "MsgNo" => $overview[0]->msgno,
                "attachmentsStatus" => $attachmentsStatus[$emailId],
                "date" => $overview[0]->date
            ];
        }
        return $MailItems;
    }

    public function disconnect()
    {
        imap_close($this->connection);
    }
}
