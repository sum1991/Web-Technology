package com.example.surabhi.forecast;

import android.content.Context;
import android.graphics.Color;
import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;

public class MoreDetails extends AppCompatActivity {


    String json_Data;
    String timeZone;
    JSONObject json_obj;
    JSONArray dailyData;
    JSONArray tab3Data;
    TableLayout caseTable=null;
    String colorValues[]={"","#9FE6FE","#FEC3E9","#C4FFA5","#FFBDB7","#EFFFB5","#BCBEFF","#FEDA69"};
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_more_details);
        json_Data = getIntent().getStringExtra(resultsActivity.MOREDETAILSSTRING);
        parseData(json_Data);
        createRows(json_obj);
    }
    private void createRows(JSONObject j)
    {
        Button btn = (Button)findViewById(R.id.button);
        btn.setBackgroundResource(R.drawable.mybutton);
        Button btn2 = (Button)findViewById(R.id.button3);
        btn2.setBackgroundColor(Color.parseColor("#487d5252"));

        try {
            dailyData = j.getJSONObject("hourly").getJSONArray("data");
            tab3Data = j.getJSONObject("daily").getJSONArray("data");

        } catch (JSONException e) {
            e.printStackTrace();
        }
        TextView tv = (TextView)findViewById(R.id.MDtext);
        tv.setText("More Details For "+Utilities.CityAddr+","+Utilities.StateAddr);

       caseTable = (TableLayout) findViewById(R.id.moreTable);
        TableRow tr1 = heading1();
        caseTable.addView(tr1,new TableLayout.LayoutParams(TableLayout.LayoutParams.WRAP_CONTENT, TableLayout.LayoutParams.WRAP_CONTENT));
        for(int i=0;i<=24;i++) {
            try {
                ImageView iv =new ImageView(this);

                iv.setImageResource(Utilities.getImage(dailyData.getJSONObject(i).getString("icon")));
                iv.setPadding(0,20,0,0);
                String t =Utilities.getTime(dailyData.getJSONObject(i).getString("time"));
                String tmp =Utilities.getTemp(dailyData.getJSONObject(i).getString("temperature"));

                TableRow TR =addRow(iv,t,tmp,i);
                if(i%2==0)
                {
                    TR.setBackgroundColor(Color.parseColor("#C8F1FF"));
                }

                caseTable.addView(TR,new TableLayout.LayoutParams(TableLayout.LayoutParams.WRAP_CONTENT, TableLayout.LayoutParams.WRAP_CONTENT));
            } catch (Exception e) {
                e.printStackTrace();
            }

        }
        final Context ct = this;
        final Button Btn = new Button(this);
        Btn.setText("+");
        Btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                for (int j = 25; j < 48; j++) {
                    ImageView iv = new ImageView(ct);

                    try {
                        iv.setImageResource(Utilities.getImage(dailyData.getJSONObject(j).getString("icon")));
                        String t = Utilities.getTime(dailyData.getJSONObject(j).getString("time"));
                        String tmp = Utilities.getTemp(dailyData.getJSONObject(j).getString("temperature"));
                        caseTable.removeView(Btn);
                        TableRow TR = addRow(iv, t, tmp, j);
                        if (j % 2 == 0) {
                            TR.setBackgroundColor(Color.parseColor("#cvcvcv"));
                        }
                        caseTable.addView(TR, new TableLayout.LayoutParams(TableLayout.LayoutParams.WRAP_CONTENT, TableLayout.LayoutParams.WRAP_CONTENT));
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }


                }
            }
        });

        caseTable.addView(Btn);

    }
  private TableRow heading1()
  {
      TableRow caseRow = new TableRow(this);
      caseRow.setOrientation(TableRow.VERTICAL);


      TextView name = new TextView(this);
      name.setWidth(200);
      name.setText("Time");
      name.setPadding(0, 25, 0, 0);
      caseRow.addView(name);
      TableRow.LayoutParams tlp= new TableRow.LayoutParams(100, 100);
      tlp.setMargins(0, 0, 100, 0);
      TextView Middle = new TextView(this);
      Middle.setLayoutParams(tlp);
      Middle.setText("Summary");
      Middle.setWidth(250);
      caseRow.addView(Middle);
      TextView Hello = new TextView(this);
      Hello.setText("Temp"+Utilities.getUnit("tp"));
      Hello.setPadding(0, 25, 0, 0);
      caseRow.addView(Hello);
      caseRow.setBackgroundColor(Color.parseColor("#84ECE6"));
      return caseRow;

  }


    private TableRow addRow(ImageView iv,String time,String temp,int i)
    {

        TableRow caseRow = new TableRow(this);
        caseRow.setOrientation(TableRow.VERTICAL);
        caseRow.setId(i);

        TextView name = new TextView(this);
        name.setWidth(200);
        name.setText(time);
        name.setPadding(0, 20, 0, 0);
        caseRow.addView(name);
        TableRow.LayoutParams tlp= new TableRow.LayoutParams(200, 150);
        tlp.setMargins(0, 0, 100, 0);
        iv.setLayoutParams(tlp);
        caseRow.addView(iv);
        TextView Hello = new TextView(this);
        Hello.setText(temp);
        Hello.setPadding(0, 20, 0, 0);
        caseRow.addView(Hello);

        return caseRow;
    }
    private TableRow addRowTab2(String Mon,String day,String Datey,String LowTemp,String HighTemp,int res,int i)
    {

        TableRow caseRow = new TableRow(this);
        caseRow.setOrientation(TableRow.VERTICAL);
        caseRow.setId(i);
        caseRow.setBackgroundColor(Color.parseColor(colorValues[i]));
        TextView name = new TextView(this);
        name.setWidth(400);

        name.setPadding(0, 20, 0, 0);
        name.setText(day + "," + Mon + "" + Datey + "\n\n\n" + "Min:"+""+ LowTemp + " | " + "Max:" + "" + HighTemp);
        name.setTypeface(null, Typeface.BOLD);
        caseRow.addView(name);
        TableRow.LayoutParams tlp= new TableRow.LayoutParams(100, 100);
        tlp.setMargins(0, 0, 100, 0);
        ImageView iv = new ImageView(this);
        iv.setImageResource(res);
        iv.setLayoutParams(tlp);
        iv.setPadding(0,20,0,0);
        caseRow.addView(iv);

        return caseRow;
    }


    private void parseData(String S )
    {
        try {
            json_obj = new JSONObject(S);
            Utilities.timeZone = json_obj.getString("timezone");
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public  void populateDays(JSONObject j)
    {       Button btn = (Button)findViewById(R.id.button3);

        btn.setBackgroundResource(R.drawable.mybutton);
        Button btn2 = (Button)findViewById(R.id.button);
        btn2.setBackgroundColor(Color.parseColor("#487d5252"));

        TextView tv = (TextView)findViewById(R.id.MDtext);
        tv.setText("More Details For "+Utilities.CityAddr+","+Utilities.StateAddr);
        for (int i =1;i<=7;i++) {
            try {
                String time = tab3Data.getJSONObject(i).getString("time");
                String tempMax = tab3Data.getJSONObject(i).getString("temperatureMax");
                String tempMin = tab3Data.getJSONObject(i).getString("temperatureMin");
                String iconVal =  tab3Data.getJSONObject(i).getString("icon");

                TableRow tab3 = addRowTab2(Utilities.Month(time), Utilities.Day(time), Utilities.DateU(time), Utilities.getTemp(tempMin), Utilities.getTemp(tempMax), Utilities.getImage(iconVal), i);
                caseTable.addView(tab3, new TableLayout.LayoutParams(TableLayout.LayoutParams.WRAP_CONTENT, TableLayout.LayoutParams.WRAP_CONTENT));
                TableRow junkRow = new TableRow(this);
                junkRow.setLayoutParams(new TableRow.LayoutParams(TableLayout.LayoutParams.MATCH_PARENT, TableLayout.LayoutParams.MATCH_PARENT));
                ImageView junkImage = new ImageView(this);
                TableRow.LayoutParams jtlp= new TableRow.LayoutParams(50, 50);
                junkImage.setLayoutParams(jtlp);
                junkRow.addView(junkImage);
                caseTable.addView(junkRow, new TableLayout.LayoutParams(TableLayout.LayoutParams.WRAP_CONTENT, TableLayout.LayoutParams.WRAP_CONTENT));
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

    }

    public void setclicklistner(View view) {
      RemoveRows();
      populateDays(json_obj);


    }

    public void RemoveRows()
    {

            //View temp = caseTable.getChildAt(i);
            caseTable.removeAllViews();



    }


    public void tab2listner(View view) {

        RemoveRows();
        createRows(json_obj);
    }
}
