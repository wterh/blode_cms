// �������-�������� ��������� http://energodar.net/vedy/kalendar.html
function KrugoLet(){
	today = new Date();
	mSec_Greg = today.getTime() - (today.getTimezoneOffset() * 60000); // ����������� �� ������� 1 ������ 1970 ���� �� "������"
	mSec_SlavAri = mSec_Greg + 21600000; // ����������� �� 16:000 21 ������� 7478 ���� �� �.�.�.�. �� "������"
	//  ���������� ������ ��� ������ ����� � �������� 3600000 �����������, ���� ������ �����
	mSec_SlavAri = mSec_SlavAri - (((new Date(2010, 0, 1)).getTimezoneOffset() - new Date().getTimezoneOffset())) * 60 * 1000;

	Vrem_SlavAri = (mSec_SlavAri % 86400000); // ������� ����������� � ����� (�������) ����� - �������
	Chas_SlavAri = Math.floor(Vrem_SlavAri / 5400000.00); // �������-�������� ��� "������" (�������)
	Chast_SlavAri = Math.floor((Vrem_SlavAri % 5400000) / 37500.00); // �������-�������� ������ ���� (�������)
	Dney_SlavAri = Math.floor(1.00 * (mSec_SlavAri / 86400000)); // ������ ����� ���� �� 21 ������� 7478 �� �.�.�.�. �� "������"
	Den_SlavAri =  1 + Math.floor(Dney_SlavAri % 9.00); //���� ������ "������" + "1", ����� ������������ ��� "1", � �� "0" � �������� - "2" �.�.

	Dney_SlavAri = Dney_SlavAri - 264;  //������� ����� ���� ����� ���������� 7479 ���� �� �.�.�.�. � �� ��������� ���� ������������
	Chislo_SlavAri = 1; //��������� ����� ������ :)
	Mes_SlavAri = 1;    //��������� ����� �������, �� ���� "������"
	Krug_Let = 7;       //��������  Krug_Let = 6  +  1
	Krug_Zizni = 103;   //��������  Krug_Zizni = 102  +  1
	S_M_Z_H = 7479;     //��������  S_M_Z_H = 7478   +   1
	//  �������� ��������� �� ��������� 7479 �� "�����"
	while(Dney_SlavAri > 0) {
	// �������� (� ����� while) ����� ������ ������� ���
	    if(Krug_Let != 16 && Dney_SlavAri >= 365 )
	        {
	        Dney_SlavAri = Dney_SlavAri - 365;
	        Chislo_SlavAri = 1;
	        Mes_SlavAri = 1;
	        Krug_Let = Krug_Let + 1;
	        Krug_Zizni = Krug_Zizni + 1;
	        S_M_Z_H = S_M_Z_H + 1;
	        }
	    // �������� (� ����� while) ����� ������ ��������� ���
	    if(Krug_Let == 16 && Dney_SlavAri >= 369)
	        {
	        Dney_SlavAri = Dney_SlavAri - 369;
	        Chislo_SlavAri = 1;
	        Mes_SlavAri = 1;
	        Krug_Let = 1;
	        if(Krug_Zizni == 144) Krug_Zizni = 1; else Krug_Zizni = Krug_Zizni + 1;
	        S_M_Z_H = S_M_Z_H + 1;
	        }
	    // �������� (� ����� while) ��� �������� ���� ����� ������ �������� ������� - �� 41 ���
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
	    // �������� (� ����� while) ��� �������� ���� ����� ������ ������ ������� - �� 40 ����
	    if(Krug_Let != 16 && Dney_SlavAri < 365 && Dney_SlavAri >= 40 && Mes_SlavAri != 1 && Mes_SlavAri != 3 && Mes_SlavAri != 5 && Mes_SlavAri != 7 && Mes_SlavAri != 9)
	        {
	        Dney_SlavAri = Dney_SlavAri - 40;
	        Chislo_SlavAri = 1;
	        Mes_SlavAri = Mes_SlavAri + 1;
	        }
	    // �������� (� ����� while) ��� ���������� ���� ����� ������ ������� - �� 41 ���
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

	    // �������� (� ����� while) ��� �������� ���� ����� ���� � �������� ������� - ������� �� 41 ���
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

	    // �������� (� ����� while) ��� �������� ���� ����� ���� � ������ ������� - ������� �� 40 ����
	    if (Krug_Let != 16 && Dney_SlavAri > 0 && Dney_SlavAri < 40 && Mes_SlavAri != 1 && Mes_SlavAri != 3 && Mes_SlavAri != 5 && Mes_SlavAri != 7 && Mes_SlavAri != 9) {

	        Dney_SlavAri = Dney_SlavAri - 1;
	        if (Chislo_SlavAri == 40) {
	            Chislo_SlavAri = 1;
	            Mes_SlavAri = Mes_SlavAri + 1;
	        } else Chislo_SlavAri = Chislo_SlavAri + 1;
	    }

	    // �������� (� ����� while) ��� ���������� ���� ����� ���� � ������ - ������� ��� �� 41 ���
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
