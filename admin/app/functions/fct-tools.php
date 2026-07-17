<?php

declare(strict_types=1);

function filterInputs($data)
{
    if (is_array($data)) {
        return array_map('filterInputs', $data);
    }

    if ($data === null) {
        return '';
    }

    return trim(strip_tags((string) $data));
}

function uiEscape($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

function appUrl(string $path = ''): string
{
    return rtrim(DOMAIN, '/') . '/' . ltrim($path, '/');
}

function safeRestaurantImageUrl($path): string
{
    $path = trim((string) $path);
    if ($path === '') {
        return '';
    }

    if (filter_var($path, FILTER_VALIDATE_URL)) {
        $scheme = strtolower((string) parse_url($path, PHP_URL_SCHEME));
        return in_array($scheme, ['http', 'https'], true) ? $path : '';
    }

    $path = ltrim(str_replace('\\', '/', $path), '/');
    if ($path === '' || str_contains($path, '..')) {
        return '';
    }

    if (str_starts_with($path, 'admin/')) {
        return appUrl($path);
    }

    if (str_starts_with($path, 'uploads/')) {
        return appUrl('admin/' . $path);
    }

    return appUrl($path);
}

function sanitizeRichTextNode(DOMNode $node, array $allowedTags): void
{
    $children = [];
    foreach ($node->childNodes as $child) {
        $children[] = $child;
    }

    foreach ($children as $child) {
        if ($child instanceof DOMElement) {
            sanitizeRichTextNode($child, $allowedTags);
            $tagName = strtolower($child->tagName);

            if (!in_array($tagName, $allowedTags, true)) {
                $parent = $child->parentNode;
                if ($parent !== null) {
                    while ($child->firstChild !== null) {
                        $parent->insertBefore($child->firstChild, $child);
                    }
                    $parent->removeChild($child);
                }
                continue;
            }

            while ($child->attributes->length > 0) {
                $attribute = $child->attributes->item(0);
                if ($attribute !== null) {
                    $child->removeAttributeNode($attribute);
                }
            }
        } elseif (!($child instanceof DOMText)) {
            if ($child->parentNode !== null) {
                $child->parentNode->removeChild($child);
            }
        }
    }
}

function sanitizeRichText($html): string
{
    $html = trim((string) $html);
    if ($html === '') {
        return '';
    }

    $html = html_entity_decode(
        $html,
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );

    if (!class_exists('DOMDocument')) {
        return nl2br(uiEscape(strip_tags($html)));
    }

    $document = new DOMDocument('1.0', 'UTF-8');
    $previousSetting = libxml_use_internal_errors(true);
    $loaded = $document->loadHTML(
        '<?xml encoding="UTF-8"><div id="safe-rich-text">'
        . $html
        . '</div>',
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    );
    libxml_clear_errors();
    libxml_use_internal_errors($previousSetting);

    if (!$loaded) {
        return nl2br(uiEscape(strip_tags($html)));
    }

    $root = $document->getElementById('safe-rich-text');
    if ($root === null) {
        return nl2br(uiEscape(strip_tags($html)));
    }

    sanitizeRichTextNode(
        $root,
        [
            'div', 'p', 'br', 'strong', 'b', 'em', 'i', 'u',
            'ul', 'ol', 'li', 'h2', 'h3', 'h4', 'blockquote',
        ]
    );

    $safeHtml = '';
    foreach ($root->childNodes as $child) {
        $safeHtml .= $document->saveHTML($child);
    }

    return $safeHtml;
}

function disp_ar($array, $info = null, $type = 'PR'): void
{
    if (!defined('DEBUG') || DEBUG !== true) {
        return;
    }

    echo '<pre>';
    if ($info !== null) {
        echo '<strong>' . uiEscape($info) . '</strong>' . PHP_EOL;
    }

    ob_start();
    if ($type === 'VD') {
        var_dump($array);
    } else {
        print_r($array);
    }
    echo uiEscape((string) ob_get_clean());
    echo '</pre>';
}
