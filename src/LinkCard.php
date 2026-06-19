<?php

/**
 * Class LinkCard
 *
 * Renders a safe, escaped HTML snippet for a link card.
 */
class LinkCard
{
    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string|null
     */
    private ?string $description;

    /**
     * @var string|null
     */
    private ?string $image;

    /**
     * @param string      $url
     * @param string      $title
     * @param string|null $description
     * @param string|null $image
     */
    public function __construct(
        string $url,
        string $title,
        ?string $description = null,
        ?string $image = null
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Render the link card as an HTML string.
     *
     * @return string
     */
    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = $this->description !== null
            ? htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8')
            : null;
        $escapedImage = $this->image !== null
            ? htmlspecialchars($this->image, ENT_QUOTES | ENT_HTML5, 'UTF-8')
            : null;

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';

        if ($escapedImage !== null) {
            $html .= '<img src="' . $escapedImage . '" alt="' . $escapedTitle . '" class="link-card-image" />';
        }

        $html .= '<div class="link-card-content">';
        $html .= '<span class="link-card-title">' . $escapedTitle . '</span>';

        if ($escapedDescription !== null) {
            $html .= '<span class="link-card-description">' . $escapedDescription . '</span>';
        }

        $html .= '<span class="link-card-url">' . $escapedUrl . '</span>';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Create a pre-configured sample card.
     *
     * @return self
     */
    public static function createSample(): self
    {
        return new self(
            'https://app-portal-leyu.com.cn',
            '乐鱼体育',
            '乐鱼体育 - 专业的体育赛事平台',
            null
        );
    }
}

// Example usage (commented out for production):
// $card = LinkCard::createSample();
// echo $card->render();