// Prikaz mesečnega razpisa (PDF) na telefonu.
// Brskalniki na telefonih (zlasti Chrome na Androidu) PDF-ja v okvirju (iframe) ne prikažejo,
// ampak ga ponudijo za prenos. Na telefonu zato PDF narišemo sami s knjižnico PDF.js.
// Na računalniku ostane vgrajen pregledovalnik PDF (iframe), kot doslej.

var PDFJS_POT = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/";

function jeTelefon() {
	var grobKazalec = window.matchMedia && window.matchMedia("(pointer: coarse)").matches;
	return grobKazalec || navigator.pdfViewerEnabled === false;
}

// knjižnico PDF.js naložimo šele, ko je prvič potrebna
var pdfjsNalaganje = null;
function naloziPdfJs() {
	if (window.pdfjsLib) { return Promise.resolve(window.pdfjsLib); }
	if (pdfjsNalaganje) { return pdfjsNalaganje; }
	pdfjsNalaganje = new Promise(function (uspeh, napaka) {
		var s = document.createElement("script");
		s.src = PDFJS_POT + "pdf.min.js";
		s.onload = function () {
			window.pdfjsLib.GlobalWorkerOptions.workerSrc = PDFJS_POT + "pdf.worker.min.js";
			uspeh(window.pdfjsLib);
		};
		s.onerror = function () { pdfjsNalaganje = null; napaka(new Error("PDF.js se ni naložil")); };
		document.head.appendChild(s);
	});
	return pdfjsNalaganje;
}

function prikaziPdfNaTelefonu(pot, okvir) {
	okvir.style.height = "auto";
	okvir.style.backgroundColor = "white";
	okvir.innerHTML = '<p style="padding:10px">Nalagam razpis ...</p>';

	naloziPdfJs()
		.then(function (pdfjsLib) { return pdfjsLib.getDocument(pot).promise; })
		.then(function (pdf) {
			okvir.innerHTML = "";
			var sirina = okvir.clientWidth || window.innerWidth;
			// ostrina: rišemo v višji ločljivosti, da je pri povečavi s prsti še berljivo
			var gostota = Math.min((window.devicePixelRatio || 1) * 2, 4);
			var veriga = Promise.resolve();
			for (var i = 1; i <= pdf.numPages; i++) {
				(function (st) {
					veriga = veriga.then(function () { return pdf.getPage(st); })
						.then(function (stran) {
							var osnova = stran.getViewport({ scale: 1 });
							var merilo = sirina / osnova.width;
							var pogled = stran.getViewport({ scale: merilo * gostota });
							var platno = document.createElement("canvas");
							platno.width = Math.floor(pogled.width);
							platno.height = Math.floor(pogled.height);
							platno.style.width = "100%";
							platno.style.display = "block";
							platno.style.marginBottom = "8px";
							okvir.appendChild(platno);
							return stran.render({ canvasContext: platno.getContext("2d"), viewport: pogled }).promise;
						});
				})(i);
			}
			return veriga;
		})
		.catch(function () {
			// če ne gre (npr. ni povezave do PDF.js), ponudimo vsaj povezavo do datoteke
			okvir.innerHTML = '<p style="padding:10px">Razpisa ni bilo mogoče prikazati. ' +
				'<a href="' + pot + '" target="_blank">Odpri PDF</a></p>';
		});
}
