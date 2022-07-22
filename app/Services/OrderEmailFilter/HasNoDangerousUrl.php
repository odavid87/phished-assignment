<?php

namespace App\Services\OrderEmailFilter;

use Snipe\Safebrowsing\Facade\Safebrowsing;
use Webklex\PHPIMAP\Message;

class HasNoDangerousUrl implements IOrderEmailFilter
{
    /**
     * @param Message $emailMessage
     * @return bool
     *
     * This method make api calls to google's Safe browsing API
     * @see https://developers.google.com/safe-browsing/v4
     */
    public function filter(Message $emailMessage): bool
    {
        $urlsInEmail = $this->collectUrlsFrom($emailMessage);
        if (empty($urlsInEmail)) {
            return true;
        }

        Safebrowsing::addCheckUrls($urlsInEmail);
        Safebrowsing::execute();
        foreach ($urlsInEmail as $url) {
            if (Safebrowsing::isFlagged($url)) {
                return false;
            }
        }
        return true;
    }

    private function collectUrlsFrom(Message $emailMessage):array
    {
        $urls = [];
        $textAndHtmlContent = $emailMessage->getTextBody() . $emailMessage->getHTMLBody();
        if(preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $textAndHtmlContent, $matches)) {
            $urls = collect($matches[0])->unique()->toArray();
        }
        return $urls;
    }
}
