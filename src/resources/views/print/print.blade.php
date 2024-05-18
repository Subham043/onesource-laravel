<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>1Source | Print</title>
								<style nonce="{{ csp_nonce() }}">
												body {
																visibility: hidden;
												}
								</style>
				</head>

				<body>

				</body>
				<script type="text/javascript" nonce="{{ csp_nonce() }}">
								document.addEventListener('DOMContentLoaded', function() {

												var frame1 = document.createElement('iframe');
												frame1.setAttribute("name", "frame1");
												frame1.setAttribute("class", "frame1");
												document.body.appendChild(frame1);
												var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ?
																frame1.contentDocument.document : frame1.contentDocument;
												frameDoc.document.open();
												frameDoc.document.write(
																'<style>@page {size: landscape !important; margin: 5px;max-height:100%;} </style>'
												);

												//Append the DIV contents.
												frameDoc.document.write(`{!! $print !!}`);
												// frameDoc.document.write('</body></html>');
												frameDoc.document.close()
												setTimeout(function() {
																window.frames["frame1"].focus();
																window.frames["frame1"].print();
																frame1.remove();
												}, 1000);
								})
				</script>

</html>
