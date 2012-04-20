<?php
namespace Enrico\BlogBundle\Twig\Extensions;

class EnricoBlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0)
            throw new \Exception("createdAgo is unable to handle dates in the future");

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = $time . " secondi" . (($time > 1) ? "" : "") . " fa";
        }
        else if ($delta <= 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration = $time . " minut" . (($time <= 1) ? "o" : "") . (($time > 1) ? "i" : "") . " fa";
        }
        else if ($delta <= 86400)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration = $time . " or" . (($time <= 1) ? "a" : "").(($time > 1) ? "e" : "") . " fa";
        }
        else
        {
            // Days
            $time = floor($delta / 86400);
            $duration = $time . " giorn" . (($time <= 1) ? "o" : "").(($time > 1) ? "i" : "") . " fa";
        }

        return $duration;
    }

    public function getName()
    {
        return 'enrico_blog_extension';
    }
}
