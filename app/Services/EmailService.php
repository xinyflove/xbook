<?php
/**
 * 邮件服务
 */
namespace App\Services;

use App\Models\Email;
use App\Models\File;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * 发送自定义邮件
     * @param $from 发送地址
     * @param $fromName 发送名称
     * @param $to 接受地址(邮件地址数组)
     * @param $subject 邮件主题
     * @param $content 邮件内容
     * @param array $attach 附件ID(文件ID数组)
     * @param array $cc 抄送地址(邮件地址数组)
     * @return bool
     * @throws Exception
     */
    public static function send($from, $fromName, $to, $subject, $content, $attach=[], $cc=[])
    {
        if (!is_array($to)) {
            $to = [$to];
        }

        $attaches = [];
        if ($attach)
        {
            if (!is_array($attach)) {
                $attach = [$attach];
            }

            $files = File::find($attach, ['name', 'path']);
            foreach ($files as $f)
            {
                $attaches[] = [
                    'name' => $f->name,
                    'path' => public_path($f->path)
                ];
            }
        }

        try {
            Mail::send('email', ['content'=>$content]
                , function ($message) use ($from, $fromName, $to, $subject, $attaches, $cc) {
                    $message->from($from, $fromName);
                    $message->to($to);
                    $message->subject($subject);
                    if(!empty($attaches)){
                        $size = sizeOf($attaches); //get the count of number of attachments
                        for($i=0;$i<$size;$i++){
                            $message->attach($attaches[$i]['path'], ['as'=>$attaches[$i]['name']]);
                        }
                    }
                    if(!empty($cc)) {
                        if (!is_array($cc)) {
                            $cc = [$cc];
                        }
                        $message->cc($cc);
                    }
                });

            $insert_arr = [];
            foreach($to as $t){
                $insert_arr[] = [
                    'to_mail' => $t,
                    'from_mail' => $from,
                    'title' => $subject,
                    'content' => $content,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }

            //插入记录
            $record = new Email();
            $record->insert($insert_arr);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        return true;
    }

    /**
     * 发送邮件指定接收者邮箱
     * @param $to 接受地址(邮件地址数组)
     * @param $subject 邮件主题
     * @param $content 邮件内容
     * @param array $attach 附件ID(文件ID数组)
     * @param array $cc 抄送地址(邮件地址数组)
     * @return bool
     * @throws Exception
     */
    public static function sendTo($to, $subject, $content, $attach=[], $cc=[])
    {
        $from = config('mail.from.address');
        $fromName = config('mail.from.name');

        return self::send($from, $fromName, $to, $subject, $content, $attach, $cc);
    }
}