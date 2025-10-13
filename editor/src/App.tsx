import { SimpleEditor } from "./components/tiptap-templates/simple/simple-editor";

function App() {
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  const appData = (window as any).__APP_DATA__;

  return (
    <SimpleEditor
      data={appData.draftContent}
      blogId={appData.blogId}
      authorId={appData.authorId}
    />
  );
}

export default App;
