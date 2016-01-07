package com.example.surabhi.forecast;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Spinner;
import android.widget.TextView;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;


public class MainActivity extends ActionBarActivity {

    public static final String JSON_STRING = "json_String";
    Button mButton;
    EditText mStreeet;
    EditText mCity;
    TextView error;
    Spinner mState;
    String StreetAddress="";
    String CityAddress="";
    String StateAddress="";
    String tempera;
    String send="";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);



    }






    public void setclicklistner(View view)
    {
        Boolean validate=true;
        error = (TextView)findViewById(R.id.Error);

        mStreeet   = (EditText)findViewById(R.id.editText);
        StreetAddress = (String) mStreeet.getText().toString();

        mCity = (EditText)findViewById(R.id.editText2);
        CityAddress = (String) mCity.getText().toString();

        mState = (Spinner)findViewById(R.id.St);
        StateAddress = (String) mState.getSelectedItem().toString();
        if(((RadioButton)findViewById(R.id.fah)).isChecked())
        {
            tempera="Fahrenheit";
            send ="Farenhiet";
        }
        else
        {
            tempera="Celsius";
            send ="Celsius";

        }
        Log.v("values of the street",StreetAddress);
        Log.v("values of the City",CityAddress);
        Log.v("values of the State",StateAddress);
        if(StreetAddress.equals(""))
        {
             validate= false;
             error.setText("Enter The Street Address");

        }
        else if (validate && CityAddress.equals(""))
        {
            validate= false;
            error.setText("Enter The City Address");
        }else if (validate && StateAddress.equals("Select"))
        {
            validate= false;
            error.setText("Enter The State");
        }
        else if((((RadioButton)findViewById(R.id.fah)).isChecked()) == false && (((RadioButton)findViewById(R.id.cel)).isChecked())==false)
        {
            error.setText("Enter The State");
            return;
        }


       if(validate) {
           error.setText("");
           new GetJsonData(this).execute();


       }

    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    public void clearBtn(View view) {

        CityAddress ="";
        StateAddress="";
        StreetAddress="";

        mStreeet   = (EditText)findViewById(R.id.editText);
        mCity = (EditText)findViewById(R.id.editText2);
        mState = (Spinner)findViewById(R.id.St);
        error = (TextView)findViewById(R.id.Error);
        mCity.setText("");
        mStreeet.setText("");
        mState.setSelection(0);
        error.setText("");

    }

    public void abotActivity(View view) {


        Intent resultsIntent= new Intent(this,AboutActive.class);
        startActivity(resultsIntent);

    }

    public void RadioListner(View view) {
        Log.d("RB Clicked","Success1");
        RadioButton clickedButton = (RadioButton)view;
        int name=clickedButton.getId();
        Log.d("RB Clicked","Success2" );
        if(name == R.id.fah)
        {
            RadioButton otherButtonCel = (RadioButton)findViewById(R.id.cel);
            otherButtonCel.setChecked(false);
        }
        else
        {
            RadioButton otherButtonFah = (RadioButton)findViewById(R.id.fah);
            otherButtonFah.setChecked(false);
        }
        Log.d("RB Clicked","Success3");

    }

    public void imagelistner(View view) {
        Intent intent = new Intent();
        intent.setAction(Intent.ACTION_VIEW);
        intent.addCategory(Intent.CATEGORY_BROWSABLE);
        intent.setData(Uri.parse("http://forecast.io/"));
        startActivity(intent);

    }


    private class GetJsonData extends AsyncTask<String,Integer,String>
    {
        Activity A;
        protected GetJsonData(MainActivity Main)
    {
        A=Main;

    }

        @Override
        protected String doInBackground(String... strings) {
            HttpURLConnection urlconnection;
            BufferedReader reader = null;
            String jSonData = null;
            try {

                String urlstring = "http://forecastapp-env.elasticbeanstalk.com/index.php?streetInput="+ URLEncoder.encode(StreetAddress)+"&cityInput="+ URLEncoder.encode(CityAddress)+"&stateInput="+ URLEncoder.encode(StateAddress)+"&Temperature="+URLEncoder.encode(send);


                URL url = new URL(urlstring);
               urlconnection = (HttpURLConnection) url.openConnection();
               urlconnection.setRequestMethod("GET");
               urlconnection.connect();
                InputStream inputstream = urlconnection.getInputStream();
                StringBuffer buffer = new StringBuffer();
                if(inputstream == null) {
                }
                reader = new BufferedReader(new InputStreamReader(inputstream));
                String line;
                while ((line = reader.readLine())!= null) {

                    buffer.append(line+"\n");

                }
               jSonData = buffer.toString();
                //Log.d("Json", jSonData);
                Intent resultsIntent= new Intent(A,resultsActivity.class);
                Utilities.StreetAddr = StreetAddress;
                Utilities.CityAddr = CityAddress;
                Utilities.StateAddr= StateAddress;
                Utilities.temptype= tempera;

                resultsIntent.putExtra(JSON_STRING,jSonData);
                resultsIntent.putExtra("saddr",StreetAddress);
                resultsIntent.putExtra("caddr", CityAddress);
                resultsIntent.putExtra("saddra",StateAddress);
                startActivity(resultsIntent);

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }


            return null;
        }
    }
    }


