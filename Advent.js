//カレンダーの初期設定
const week = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
const today = new Date();
const calendar_month = new Date(2022,7);
var calendar_list = [];
calendar_list.length = 31;
var member_counter = 0;


function Day()
{
	var year = 20;
	document.querySelector('#calendar').innerHTML = year + "年 ";
}

function member_show()
{
	for(i=1 ; i <= calendar_list ; i++)
	{
			member_counter ++;
	}
	
}

function enter(e)
{
	var e = e || window.event;
	var elem = e.target || e.srcElement;
	var elemId = elem.id;
	
	//const id_data = e.currentTarget.dataset['index'];
	
	//var id_data = "aho";
	var result =prompt("表示テスト");

	if(result)
		{
			//file_save('text.txt',result);
			
			var list = list_control(elemId,result);
			document.querySelector('#list').innerHTML = list;
			member_show();
		}
	
	else{}
}

function list_control(listID,result)
{
	var list = "";
	var listNumber = Number(listID);
	calendar_list[listNumber] = result;
}

window.onload = function()
{	
	showProcess(calendar_month, calendar);
};

function showProcess(date)
{
	var year = date.getFullYear();
	var month = date.getMonth();
	document.querySelector('#test').innerHTML = year + "年 " + (month+1) + "月";
	
	var calendar = createProcess(year,month);
	document.querySelector('#calendar').innerHTML = calendar;
	
}

function createProcess(year,month)
{
	//曜日部分を作る

	var calendar = "<table><tr class='dayOfWeek'>";
	for(var i=0; i<week.length; i++) 
	{

		if(i==0) //日曜日
		{
					calendar += "<th class='first_day'>" + week[i] + "</th>"
				}
			
		else if(i==week.length-1) //土曜日
		{
					calendar += "<th class='end_day'>" + week[i] + "</th>"
				}
			
		else
		{
					calendar += "<th>" + week[i] + "</th>"
				}
	}
	calendar += "</tr>"
	
	//日付部分を作る
	var count = 0;
	var startDayOfWeek = new Date(year,month,1).getDay();
	var startDate = new Date(year,month).setDate(1);
	var endDate = new Date(year,month+1,0).getDate();
	var row = Math.ceil((startDayOfWeek + endDate) / week.length);

	for(i=0 ; i<row; i++)
		{
			calendar += "<tr class='days'>";
			
			for(j=0 ; j < week.length ; j++)
				{
					
					if(i==0 && j <startDayOfWeek) //前の月の最後の部分
						{
							calendar += "<td class='disabled'></td>";
						}
					
					else if(count>=endDate) //次の月の最初の部分
						{
							count++;
							calendar += "<td class='disabled'></td>";
						}

					else{
							count++;
						
							calendar += 
							"<td>" + 
							count + "<br>";


							//ここでデータが存在するときとしないときで分ける
							if(count == 5)
							{
								calendar +=
								"<p class='writer'>" + "この日は登録済みです" + "</p>"; //投稿者の名前を出すようにする
							}
							
							else
							{
								calendar += 
								"<form method='POST' action='Advent_list_maneger.php'>" +
								"<input type='hidden' name='date' value='" + count + "'></p>" +
								"<p>名前：<input type='text' name='name'></p>" +
								"<p>タイトル：<input type='text' name='title'></p>" +
								"<input type='submit'>" +
								"</form>";
							}
						}
				}
			
			calendar += "</tr>"
		}
	
	calendar += "</table>"
	member_show();
	return calendar;
}