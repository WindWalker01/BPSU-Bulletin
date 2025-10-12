<?php

namespace Core\TiptapExtension;

use Tiptap\Core\Node;

class Youtube extends Node
{
    public static $name = "youtube";

    public function renderHTML($node, $HTMLAttributes = []): array
    {
        // $node is an object (stdClass), not an array
        $src = $node->attrs->src ?? "";
        $width = $node->attrs->width ?? 640;
        $height = $node->attrs->height ?? 360;

        // 🔧 Automatically convert "watch?v=" to "embed/"
        if (strpos($src, "watch?v=") !== false) {
            $src = str_replace("watch?v=", "embed/", $src);
        }

        return [
            "iframe",
            [
                "src" => $src,
                "width" => $width,
                "height" => $height,
                "frameborder" => "0",
                "allowfullscreen" => "true",
            ],
        ];
    }
}
