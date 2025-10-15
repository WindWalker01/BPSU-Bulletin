// src/components/tiptap-ui/youtube-popover.tsx
"use client";

import * as React from "react";
import { useTiptapEditor } from "@/hooks/use-tiptap-editor";
import { useIsMobile } from "@/hooks/use-mobile";
import { Youtube } from "lucide-react"; // or use a Lucide icon
import { Button } from "@/components/tiptap-ui-primitive/button";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/tiptap-ui-primitive/popover";
import { Input, InputGroup } from "@/components/tiptap-ui-primitive/input";
import {
  Card,
  CardBody,
  CardItemGroup,
} from "@/components/tiptap-ui-primitive/card";

// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const YoutubePopover: React.FC<{ editor?: any }> = ({
  editor: providedEditor,
}) => {
  const { editor } = useTiptapEditor(providedEditor);
  const [url, setUrl] = React.useState("");
  const [isOpen, setIsOpen] = React.useState(false);
  const isMobile = useIsMobile();

  const insertYoutube = React.useCallback(() => {
    if (!editor || !url) return;
    editor
      .chain()
      .focus()
      .setYoutubeVideo({
        src: url,
        width: 640,
        height: 360,
      })
      .run();
    setIsOpen(false);
    setUrl("");
  }, [editor, url]);

  const handleKeyDown = (e: React.KeyboardEvent) => {
    if (e.key === "Enter") {
      e.preventDefault();
      insertYoutube();
    }
  };

  return (
    <Popover open={isOpen} onOpenChange={setIsOpen}>
      <PopoverTrigger asChild>
        <Button
          type="button"
          data-style="ghost"
          tooltip="Insert YouTube Video"
          onClick={() => setIsOpen((prev) => !prev)}
        >
          <Youtube className="tiptap-button-icon" /> Embed
        </Button>
      </PopoverTrigger>

      <PopoverContent>
        <Card style={isMobile ? { boxShadow: "none", border: 0 } : {}}>
          <CardBody style={isMobile ? { padding: 0 } : {}}>
            <CardItemGroup orientation="horizontal">
              <InputGroup>
                <Input
                  type="url"
                  placeholder="Paste a YouTube link..."
                  value={url}
                  onChange={(e) => setUrl(e.target.value)}
                  onKeyDown={handleKeyDown}
                  autoFocus
                  autoComplete="off"
                />
              </InputGroup>
              <Button
                data-style="ghost"
                onClick={insertYoutube}
                disabled={!url}
                title="Insert video"
              >
                Insert
              </Button>
            </CardItemGroup>
          </CardBody>
        </Card>
      </PopoverContent>
    </Popover>
  );
};
