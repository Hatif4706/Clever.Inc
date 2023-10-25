const canvases = [...document.getElementsByClassName('document')];
const pdfjsLib = window['pdfjs-dist/build/pdf'];
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

for (const canvas of canvases) {
    const loadingTask = pdfjsLib.getDocument(canvas.dataset.src);
    loadingTask.promise.then(function(pdf) {

      const pageNumber = 1;
      pdf.getPage(pageNumber).then(function(page) {

        const viewport = page.getViewport({scale: 1});
        const context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderContext = {
          canvasContext: context,
          viewport: viewport
        };

        page.render(renderContext);
      });
    }, function (reason) {
      console.error(reason);
    });
}
