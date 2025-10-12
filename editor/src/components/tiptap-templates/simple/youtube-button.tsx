import { useCurrentEditor } from "@tiptap/react";
import { Button } from "@/components/tiptap-ui-primitive/button";
import { Youtube } from "lucide-react";

export function YoutubeButton() {
  const { editor } = useCurrentEditor();

  const handleAddVideo = () => {
    const url = prompt("Enter YouTube video URL:");
    if (url && editor) {
      editor
        .chain()
        .focus()
        .setYoutubeVideo({
          src: url,
          width: 640,
          height: 360,
        })
        .run();
    }
  };

  return (
    <Button data-style="ghost" onClick={handleAddVideo}>
      <Youtube className="tiptap-button-icon" />
      Embed Youtube Video
    </Button>
  );
}
