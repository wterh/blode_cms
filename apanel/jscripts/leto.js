// Славяно-Арийский календарь http://energodar.net/vedy/kalendar.html
function KrugoLet(){
	today = new Date();
	mSec_Greg = today.getTime() - (today.getTimezoneOffset() * 60000); // миллисекунд от полночи 1 января 1970 года до "сейчас"
	mSec_SlavAri = mSec_Greg + 21600000; // миллисекунд от 16:000 21 Бейлетъ 7478 лета от С.М.З.Х. до "сейчас"
	//  определяем зимнее или летнее время и отнимаем 3600000 миллисекунд, если летнее время
	mSec_SlavAri = mSec_SlavAri - (((new Date(2010, 0, 1)).getTimezoneOffset() - new Date().getTimezoneOffset())) * 60 * 1000;

	Vrem_SlavAri = (mSec_SlavAri % 86400000); // остаток миллисекунд в новых (текущих) сутка - сегодня
	Chas_SlavAri = Math.floor(Vrem_SlavAri / 5400000.00); // Славяно-Арийский час "числом" (текущий)
	Chast_SlavAri = Math.floor((Vrem_SlavAri % 5400000) / 37500.00); // Славяно-Арийских частей часа (текущих)
	Dney_SlavAri = Math.floor(1.00 * (mSec_SlavAri / 86400000)); // прошло целых дней от 21 Бейлетъ 7478 от С.М.З.Х. до "сейчас"
	Den_SlavAri =  1 + Math.floor(Dney_SlavAri % 9.00); //День недели "числом" + "1", чтобы Понедельникъ был "1", а не "0" и Вторникъ - "2" т.д.

	Dney_SlavAri = Dney_SlavAri - 264;  //Получим число дней между Новолетием 7479 Лета от С.М.З.Х. и по вчерашний день включительно
	Chislo_SlavAri = 1; //Следующее Число первое :)
	Mes_SlavAri = 1;    //Следующий Месяц Рамхатъ, то есть "первый"
	Krug_Let = 7;       //исходное  Krug_Let = 6  +  1
	Krug_Zizni = 103;   //Исходное  Krug_Zizni = 102  +  1
	S_M_Z_H = 7479;     //Исходное  S_M_Z_H = 7478   +   1
	//  осталось посчитать от Новолетия 7479 до "вчера"
	while(Dney_SlavAri > 0) {
	// отнимает (в цикле while) число полных Простых Лет
	    if(Krug_Let != 16 && Dney_SlavAri >= 365 )
	        {
	        Dney_SlavAri = Dney_SlavAri - 365;
	        Chislo_SlavAri = 1;
	        Mes_SlavAri = 1;
	        Krug_Let = Krug_Let + 1;
	        Krug_Zizni = Krug_Zizni + 1;
	        S_M_Z_H = S_M_Z_H + 1;
	        }
	    // отнимает (в цикле while) число полных Священных Лет
	    if(Krug_Let == 16 && Dney_SlavAri >= 369)
	        {
	        Dney_SlavAri = Dney_SlavAri - 369;
	        Chislo_SlavAri = 1;
	        Mes_SlavAri = 1;
	        Krug_Let = 1;
	        if(Krug_Zizni == 144) Krug_Zizni = 1; else Krug_Zizni = Krug_Zizni + 1;
	        S_M_Z_H = S_M_Z_H + 1;
	        }
	    // отнимает (в цикле while) для Простого Лета число полных нечетных Месяцев - по 41 дню
	    if(Krug_Let != 16 && Dney_SlavAri < 365 && Dney_SlavAri >= 41 && Mes_SlavAri != 2 && Mes_SlavAri != 4 && Mes_SlavAri != 6 && Mes_SlavAri != 8)
	        {
	        Dney_SlavAri = Dney_SlavAri - 41;
	        Chislo_SlavAri = 1;
	        if(Mes_SlavAri == 9)
	            {
	            Mes_SlavAri = 1;
	            Krug_Let = Krug_Let + 1;
	            Krug_Zizni = Krug_Zizni + 1;
	            S_M_Z_H = S_M_Z_H + 1;
	            }
	        else Mes_SlavAri = Mes_SlavAri + 1;
	        }
	    // отнимает (в цикле while) для Простого Лета число полных четных Месяцев - по 40 дней
	    if(Krug_Let != 16 && Dney_SlavAri < 365 && Dney_SlavAri >= 40 && Mes_SlavAri != 1 && Mes_SlavAri != 3 && Mes_SlavAri != 5 && Mes_SlavAri != 7 && Mes_SlavAri != 9)
	        {
	        Dney_SlavAri = Dney_SlavAri - 40;
	        Chislo_SlavAri = 1;
	        Mes_SlavAri = Mes_SlavAri + 1;
	        }
	    // отнимает (в цикле while) для Священного Лета число полных Месяцев - по 41 дню
	    if (Krug_Let == 16 && Dney_SlavAri >= 41 && Dney_SlavAri < 369) {

	        Dney_SlavAri = Dney_SlavAri - 41;
	        Chislo_SlavAri = 1;
	        if (Mes_SlavAri == 9) {

	            Mes_SlavAri = 1;
	            Krug_Let = 1;
	            if(Krug_Zizni == 144) Krug_Zizni = 1; else Krug_Zizni = Krug_Zizni + 1;
	            S_M_Z_H = S_M_Z_H + 1;
	        }
	        else Mes_SlavAri = Mes_SlavAri + 1;
	    }

	    // отнимает (в цикле while) для Простого Лета число дней в нечетных Месяцах - которые по 41 дню
	    if (Krug_Let != 16 && Dney_SlavAri > 0 && Dney_SlavAri < 41 && Mes_SlavAri != 2 && Mes_SlavAri != 4 && Mes_SlavAri != 6 && Mes_SlavAri != 8) {

	        Dney_SlavAri = Dney_SlavAri - 1;
	        if (Chislo_SlavAri == 41) {

	            Chislo_SlavAri = 1;
	            if (Mes_SlavAri == 9) {

		Mes_SlavAri = 1;
		Krug_Let = Krug_Let + 1;
		Krug_Zizni = Krug_Zizni + 1;
		S_M_Z_H = S_M_Z_H + 1;
	            } else Mes_SlavAri = Mes_SlavAri + 1;
	        }
	        else Chislo_SlavAri = Chislo_SlavAri + 1;
	    }

	    // отнимает (в цикле while) для Простого Лета число дней в четных Месяцах - которые по 40 дней
	    if (Krug_Let != 16 && Dney_SlavAri > 0 && Dney_SlavAri < 40 && Mes_SlavAri != 1 && Mes_SlavAri != 3 && Mes_SlavAri != 5 && Mes_SlavAri != 7 && Mes_SlavAri != 9) {

	        Dney_SlavAri = Dney_SlavAri - 1;
	        if (Chislo_SlavAri == 40) {
	            Chislo_SlavAri = 1;
	            Mes_SlavAri = Mes_SlavAri + 1;
	        } else Chislo_SlavAri = Chislo_SlavAri + 1;
	    }

	    // отнимает (в цикле while) для Священного Лета число дней в Месяце - которые все по 41 дню
	    if (Krug_Let == 16 && Dney_SlavAri > 0 && Dney_SlavAri < 41) {

	        Dney_SlavAri = Dney_SlavAri - 1;
	        if (Chislo_SlavAri == 41) {

	            Chislo_SlavAri = 1;
	            if (Mes_SlavAri == 9) {

		Mes_SlavAri = 1;
		Krug_Let = 1;
		if (Krug_Zizni == 144) Krug_Zizni = 1; else Krug_Zizni = Krug_Zizni + 1;
		S_M_Z_H = S_M_Z_H + 1;
	            } else Mes_SlavAri = Mes_SlavAri + 1;
	        }

	    else Chislo_SlavAri = Chislo_SlavAri + 1;

	    }
	}

	var moyindikator = document.getElementById("slav-date");
	moyindikator.value = Chislo_SlavAri + '.' + Mes_SlavAri + '.' + S_M_Z_H;
            }
