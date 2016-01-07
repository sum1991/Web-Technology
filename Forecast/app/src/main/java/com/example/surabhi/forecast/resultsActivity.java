package com.example.surabhi.forecast;

import android.content.Intent;
import android.graphics.Color;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Html;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import com.facebook.CallbackManager;
import com.facebook.FacebookCallback;
import com.facebook.FacebookException;
import com.facebook.FacebookSdk;
import com.facebook.share.Sharer;
import com.facebook.share.model.ShareLinkContent;
import com.facebook.share.widget.ShareDialog;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.lang.reflect.Array;

public class resultsActivity extends AppCompatActivity {

    public static final String MOREDETAILSSTRING = "moredetailsstring";
    public JSONObject json_obj;
    String json_Data;
    CallbackManager callbackManager;
    ShareDialog shareDialog;
    int t=0;
    String Summary="";
    String urifa="";
    private String[] currently = {
            "Precipitation",
            "Chance of Rain",
            "Wind Speed",
            "Dew Point",
            "Humidity",
            "Visibilty",
            "Sunrise",
            "Sunset"
    };
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_results);
        FacebookSdk.sdkInitialize(getApplicationContext());
        callbackManager = CallbackManager.Factory.create();
        shareDialog = new ShareDialog(this);
        shareDialog.registerCallback(callbackManager, new FacebookCallback<Sharer.Result>() {
            @Override
            public void onSuccess(Sharer.Result result) {
                Toast.makeText(getApplicationContext(), "Facebook Post Successful", Toast.LENGTH_LONG).show();
            }

            @Override
            public void onCancel() {
                Toast.makeText(getApplicationContext(), "Post Cancelled", Toast.LENGTH_LONG).show();
            }


            @Override
            public void onError(FacebookException error) {
                Toast.makeText(getApplicationContext(), "Posting Error", Toast.LENGTH_LONG).show();
            }
        });
         json_Data = getIntent().getStringExtra(MainActivity.JSON_STRING);

        parseData(json_Data);
        createRows(json_obj);
        SetImage(json_obj);
        SetTopData(json_obj);

    }



    private void SetTopData(JSONObject j)
    {
        String Temperature="";

        JSONObject daily= null;
        String lowTemp="";
        String highTemp="";

        try {
            daily = j.getJSONObject("daily");

            String timeZone = j.getString("timezone");
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JSONArray dailyData= null;
        try {
            dailyData = daily.getJSONArray("data");
        } catch (JSONException e) {
            e.printStackTrace();
        }
        try {
            t = Math.round(Float.parseFloat(j.getJSONObject("currently").getString("temperature")));
            Summary = j.getJSONObject("currently").getString("summary");
            String degSymbol = Html.fromHtml("<span>&deg<span>")+"";
            lowTemp = Math.round(Float.parseFloat(dailyData.getJSONObject(0).getString("temperatureMin")))+degSymbol;
            highTemp = Math.round(Float.parseFloat(dailyData.getJSONObject(0).getString("temperatureMin")))+degSymbol;

        } catch (JSONException e) {
            e.printStackTrace();
        }
        TextView summaryV = (TextView)findViewById(R.id.Summary);
        summaryV.setText(Summary+" in "+Utilities.CityAddr+","+Utilities.StateAddr);

        TextView TempV = (TextView)findViewById(R.id.Temperature);
        //TempV.setText(String.valueOf(t)+Utilities.getUnit("tp"));
        TempV.setText(Html.fromHtml(String.valueOf(t)+"<sup><small>"+Utilities.getUnit("tp")+"<small></sup>"));

        TextView LowTempV = (TextView)findViewById(R.id.Lowhigh);
        LowTempV.setText("L:"+lowTemp+" | "+"H:"+highTemp);



    }
    private void SetImage(JSONObject j)
    {
        try {
            ImageView iv =(ImageView)findViewById(R.id.imageView);

            String s = j.getJSONObject("currently").getString("icon");
             urifa =s;
            switch (s)
            {
                case "clear-day":
                    iv.setImageResource(R.drawable.clear);
                    break;
                case "clear-night":
                    iv.setImageResource(R.drawable.clear_night);
                    break;
                case "rain":
                    iv.setImageResource(R.drawable.rain);
                    break;
                case "snow":
                    iv.setImageResource(R.drawable.snow);
                    break;
                case "sleet":
                    iv.setImageResource(R.drawable.sleet);
                    break;
                case "wind":
                    iv.setImageResource(R.drawable.wind);
                    break;
                case "fog":
                    iv.setImageResource(R.drawable.fog);
                    break;
                case "cloudy":
                    iv.setImageResource(R.drawable.cloudy);
                    break;
                case "partly-cloudy-day":
                    iv.setImageResource(R.drawable.cloud_day);
                    break;
                case "partly-cloudy-night":
                iv.setImageResource(R.drawable.cloud_night);
                break;

            }
        } catch (JSONException e) {
            e.printStackTrace();
        }


    }

    private void parseData(String S )
    {
        try {
            json_obj = new JSONObject(S);
            Utilities.timeZone = json_obj.getString("timezone");
            Utilities.lat = Double.parseDouble(json_obj.getString("latitude"));
            Utilities.lon = Double.parseDouble(json_obj.getString("longitude"));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private void createRows(JSONObject j)
    {



        for(int i=0;i<=7;i++) {
            try {
                addRow(currently[i],j,i);
            } catch (Exception e) {
                e.printStackTrace();
            }

        }
        }

    private void addRow(String s,JSONObject j,int i)
    {
        JSONObject Q =new JSONObject();


        TableLayout caseTable = (TableLayout) findViewById(R.id.tableL);
        TableRow TR = new TableRow(this);
        try {
            Log.d("thisresu", j.getJSONObject("currently").getString("summary"));
            Q= j.getJSONObject("currently");



        } catch (JSONException e) {
            e.printStackTrace();
        }

       switch (s)
       {
           case "Precipitation":
               try {

                   TR = AbstarctRows(Utilities.precipitaionI(Q.getString("precipIntensity")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;
           case "Chance of Rain":
               try {

                   TR = AbstarctRows(Utilities.precipitaionP(Q.getString("precipProbability")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;
           case "Wind Speed":
               try {

                   TR = AbstarctRows(Utilities.windSpeed(Q.getString("windSpeed")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;
           case "Dew Point":
               try {

                   TR = AbstarctRows(Utilities.dewPoint(Q.getString("dewPoint")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;
           case "Humidity":
               try {

                   TR = AbstarctRows(Utilities.humidity(Q.getString("humidity")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;
           case "Visibilty":
               try {

                   TR = AbstarctRows(Utilities.visibility(Q.getString("visibility")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;
           case "Sunrise":
               try {
                   JSONArray tab3Data = j.getJSONObject("daily").getJSONArray("data");
                   TR = AbstarctRows(Utilities.getTime(tab3Data.getJSONObject(0).getString("sunriseTime")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;
           case "Sunset":
               try {
                   JSONArray tab3Data = j.getJSONObject("daily").getJSONArray("data");
                   TR = AbstarctRows(Utilities.getTime(tab3Data.getJSONObject(0).getString("sunsetTime")),currently[i]);
               } catch (JSONException e) {
                   e.printStackTrace();
               }
               break;


       }





        caseTable.addView(TR, new TableLayout.LayoutParams(TableLayout.LayoutParams.WRAP_CONTENT, TableLayout.LayoutParams.WRAP_CONTENT));


    }
    private TableRow AbstarctRows(String value,String key)
    {
        TableRow caseRow = new TableRow(this);
        caseRow.setOrientation(TableRow.VERTICAL);

        TextView name = new TextView(this);
        name.setWidth(400);
        name.setPadding(0, 25, 0, 0);
        name.setText(key);
        name.setTextSize(20);
        caseRow.addView(name);
        TextView Hello = new TextView(this);
        Hello.setText(value);
        Hello.setPadding(0, 25, 0, 0);
        Hello.setTextSize(20);
        caseRow.addView(Hello);
        return caseRow;

    }


    public void moredetailsListner(View view) {
        Intent moredetails = new Intent(this,MoreDetails.class);
        moredetails.putExtra(MOREDETAILSSTRING, json_Data);
        startActivity(moredetails);
    }

    public void ViewMaplist(View view) {
        Intent mapdetails = new Intent(this,MapActivity.class);
        startActivity(mapdetails);
    }

    public void facebookshare(View view) {
        String s= Summary+","+(String.valueOf(t)+Utilities.getUnit("tp"));
        if (ShareDialog.canShow(ShareLinkContent.class)) {
            ShareLinkContent linkContent = new ShareLinkContent.Builder()
                    .setContentTitle("Current Weather in " + Utilities.CityAddr+","+Utilities.StateAddr)
                    .setContentDescription(
                            s)
                    .setContentUrl(Uri.parse("http://forecast.io/")).setImageUrl(Uri.parse(Utilities.imageUri(urifa)))
                    .build();

            shareDialog.show(linkContent);
        }



    }

    @Override
    protected void onActivityResult(final int requestCode, final int resultCode, final Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        callbackManager.onActivityResult(requestCode, resultCode, data);
    }


}
