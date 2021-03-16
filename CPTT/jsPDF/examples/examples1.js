var examples = {};
examples.SCC = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("SCC Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("SCC"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.ECC = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("ECC Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("ECC"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.BCC = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("BCC Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("BCC"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.BCC_Bunker = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("BCC Bunker Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("BCC_Bunker"));
    doc.autoTable(res.columns, res.data, {
	theme: 'grid',
	tableWidth: 'wrap',
        styles: {cellPadding: 3},
        headerStyles: {fillColor: [44, 62, 80], rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.ECMS = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("ECMS Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("ECMS"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.ECDA = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("ECDA Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("ECDA"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.ODC = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("Operations Data Center Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("ODC"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.Lobby = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("Server Lobby Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("Lobby"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.SNOC = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("SNOC Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("SNOC"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.XA21 = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("XA/21 Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("XA21"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.Sudo = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("XA/21 (Sudo) Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("Sudo"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.Network = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("Network Devices Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("Network"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.Logs = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("Log Retention/Monitoring/Security Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("Logs"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.SysOps = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("SysOps Domain Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("SysOps"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.PSS = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("Physical Security Control System Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("PSS"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.Nessus = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("Nessus Scanner Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("Nessus"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};
examples.OCRS = function () {
    var doc = new jsPDF('p', 'pt');
    doc.text("OCRS Quarterly Access Review", 30, 30);
    var res = doc.autoTableHtmlToJson(document.getElementById("OCRS"));
    doc.autoTable(res.columns, res.data, {
	tableWidth: 'wrap',
        styles: {cellPadding: 2},
        headerStyles: {rowHeight: 15, fontSize: 8},
        bodyStyles: {rowHeight: 12, fontSize: 8, valign: 'middle'}
});
    return doc;
};