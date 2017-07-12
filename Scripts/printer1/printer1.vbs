printerName = "\\prnserver01\HP LaserJet 600 printer 1 branch1"

Set objExplorer = CreateObject("InternetExplorer.Application")

objExplorer.Navigate "about:blank"  
objExplorer.ToolBar = 0
objExplorer.StatusBar = 0
objExplorer.Left = 500
objExplorer.Top = 250
objExplorer.Width = 550
objExplorer.Height = 170 
objExplorer.Visible = 1

objExplorer.Document.Title = "Ustanovka printera"

objExplorer.Document.Body.InnerHTML = "<table style=""width:100%""><tr><td id=""progress"" style=""font-family:Segoe UI;text-align: center;font-size:48px;border-bottom:1px solid black;""> Ustanovka printera: 0%</td></tr><tr><td style=""font-family:Segoe UI;text-align: center;font-size:22px;"">" & printerName & "</td></tr></table>"

Wscript.Sleep 500
objExplorer.document.getElementById("progress").innerText = " Ustanovka printera: 10%"

Set WshNetwork = CreateObject("WScript.Network")
WshNetwork.AddWindowsPrinterConnection printerName
WSHNetwork.SetDefaultPrinter printerName

Wscript.Sleep 200
objExplorer.document.getElementById("progress").innerText = " Ustanovka printera: 20%"

Wscript.Sleep 200
objExplorer.document.getElementById("progress").innerText = " Ustanovka printera: 40%"

Wscript.Sleep 200
objExplorer.document.getElementById("progress").innerText = " Ustanovka printera: 60%"

Wscript.Sleep 200
objExplorer.document.getElementById("progress").innerText = " Ustanovka printera: 80%"

Wscript.Sleep 100
objExplorer.document.getElementById("progress").innerText = " Printer ustanovlen!"

Wscript.Sleep 3000
objExplorer.Quit 
