function pad(num, size) {
	var s = num+"";
	while (s.length < size) s = "0" + s;
	return s;
}

function genWeekCSV(){

	var wOutput = ["Date,Sales amount"];

	var wTable = document.getElementById("weektable");
	var wText = document.getElementById("csvweekoutput");

	var wDates = wTable.rows.item(0).cells;
	var wSalesAmounts = wTable.rows.item(1).cells;

	for (i=0;i<8;i++)
		{
			if(wSalesAmounts.item(i).innerHTML == "-"){
				wOutput.push(wDates.item(i).innerHTML+",$0");
			} else {
				wOutput.push(wDates.item(i).innerHTML+","+wSalesAmounts.item(i).innerHTML);
			}
		}
	wOutput.push("Predicted next week,"+document.getElementById("predictedweek").innerHTML);

	wText.value = wOutput.join("\n");
	if(wOutput.length > 4){
		wText.rows = wOutput.length;
	}
}

function genMonthCSV(month, year){
	var mOutput = ["Date,Sales amount"];

	var mTable = document.getElementById("monthtable");
	var mText = document.getElementById("csvmonthoutput");

	var listRows = mTable.rows;
	var rowCount = listRows.length;
	for (i=0; i<7; i++){
		if (listRows.item(1).cells.item(i).className != "blank"){
			if(listRows.item(1).cells.item(i).getElementsByTagName("p")[0].innerHTML == "-"){
				var amount = "$0";
			} else {
				var amount = listRows.item(1).cells.item(i).getElementsByTagName("p")[0].innerHTML;
			}
			mOutput.push(pad(listRows.item(1).cells.item(i).getElementsByTagName("h5")[0].innerHTML, 2)+"/"+pad(month, 2)+"/"+year+","+amount);
		}
	}
	for (i=2;i<rowCount;i++){
		cellCount = listRows.item(i).cells.length;
		for (j=0;j<cellCount;j++){
			if(listRows.item(i).cells.item(j).getElementsByTagName("p")[0].innerHTML == "-"){
				var amount = "$0";
			} else {
				var amount = listRows.item(i).cells.item(j).getElementsByTagName("p")[0].innerHTML;
			}
			mOutput.push(pad(listRows.item(i).cells.item(j).getElementsByTagName("h5")[0].innerHTML, 2)+"/"+pad(month, 2)+"/"+year+","+amount);
		}
	}
	mOutput.push("Total,"+document.getElementById("monthtotal").innerHTML);
	mOutput.push("Predicted next month,"+document.getElementById("predictedmonth").innerHTML);

	mText.value = mOutput.join("\n");
	if(mOutput.length > 4){
		mText.rows = mOutput.length;
	}

}

function genYearCSV(year){
	var yOutput = ["Month,Sales amount"];

	var yTable = document.getElementById("yeartable");
	var yText = document.getElementById("csvyearoutput");

	var listRows = yTable.rows;

	for(i=1;i<13;i++){
		if(listRows.item(i).cells.item(1).innerHTML == "-"){
			var amount = "$0";
		} else {
			var amount = listRows.item(i).cells.item(1).innerHTML;
		}
		yOutput.push(pad(i,2)+"/"+year+","+amount);
	}
	yOutput.push("Total,"+document.getElementById("yeartotal").innerHTML)
	yOutput.push("Predicted next year,"+document.getElementById("predictedyear").innerHTML);

	yText.value = yOutput.join("\n");
	if(yOutput.length > 4){
		yText.rows = yOutput.length;
	}
}
