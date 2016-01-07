package com.example.surabhi.forecast;

import android.text.Html;
import android.widget.ImageView;

import java.security.PublicKey;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;

/**
 * Created by Sumukh on 12/7/2015.
 */
public class Utilities {

    public static String timeZone;
    public static  String temptype;
    public static String StreetAddr;
    public static String CityAddr;
    public static String StateAddr;
    public static  double lat;
    public static  double lon;

    public static String getTime(String q)
    {
        Long unixTime = Long.parseLong(q);
        Date date = new Date(unixTime*1000);
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm a");
        sdf.setTimeZone(TimeZone.getTimeZone(timeZone));
        return sdf.format(date);
    }
    public static String getTemp(String q)
    {   int t=0;
        t = Math.round(Float.parseFloat(q));
         return String.valueOf(t)+getUnit("tp");

    }
    public  static String Month(String t)
    {
        Long unixTime = Long.parseLong(t);
        Date date = new Date(unixTime*1000);
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm a");
        sdf.setTimeZone(TimeZone.getTimeZone(timeZone));
        sdf.format(date);
        String stringMonth = (String) android.text.format.DateFormat.format("MMM", date);

        return stringMonth;
    }
    public  static String Day(String t)
    {
        Long unixTime = Long.parseLong(t);
        Date date = new Date(unixTime*1000);
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm a");
        sdf.setTimeZone(TimeZone.getTimeZone(timeZone));
        sdf.format(date);
        String dayOfTheWeek = (String) android.text.format.DateFormat.format("EEEE", date);
        return dayOfTheWeek;
    }
    public  static String imageUri(String s)
    {
        String icon_image="";
        switch(s)
        {
            case "clear-day":icon_image ="clear.png";break;
            case "clear-night":icon_image ="clear_night.png";break;
            case "rain":icon_image ="rain.png";break;
            case "snow":icon_image ="snow.png";break;
            case "sleet":icon_image="sleet.png";break;
            case "wind":icon_image ="wind.png";break;
            case "fog":icon_image ="fog.png";break;
            case "cloudy":icon_image ="cloudy.png";break;
            case "partly-cloudy-day":icon_image ="cloud_day.png";break;
            case "partly-cloudy-night":icon_image ="cloud_night.png";break;
            default : break;
        }
        return "http://cs-server.usc.edu:45678/hw/hw8/images/"+icon_image;


    }
    public  static String DateU(String t)
    {
        Long unixTime = Long.parseLong(t);
        Date date = new Date(unixTime*1000);
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm a");
        sdf.setTimeZone(TimeZone.getTimeZone(timeZone));
        sdf.format(date);
        String day = (String) android.text.format.DateFormat.format("dd", date);
        return day;

    }


    public static String getUnit(String type)
    {
        if(temptype.equals("Fahrenheit"))
        {
            switch(type)
            {
                case "ws":return "mph";
                case "tp":
                case "dp" : return Html.fromHtml("&#8457")+"";
                case "vs": return "mi";
                case "ps": return "mb";
            }
        }
        else
        {
            switch(type)
            {
                case "ws":return "m/s";
                case "tp":
                case "dp" : return Html.fromHtml("&#8451")+"";
                case "vs": return "km";
                case "ps": return "hPa";
            }
        }
        return "";



    }

    public  static String precipitaionI(String s)
    {

        Float f = Float.parseFloat(s);
        if(f>=0 && f<0.002)
        {
            return "none";
        }
        if(f>=0.002 && f<0.017)
        {
            return "Very Light";
        }
        if(f>=0.017 && f<0.1)
        {
            return "Light";
        }
        if(f>=0.1 && f<0.4)
        {
            return "Moderate";
        }
        if(f>=0.4)
        {
            return "Heavy";
        }

        return "";
    }
    public  static String precipitaionP(String s)
    {
        String i;

        i =Math.round(Float.parseFloat(s) * 100) + "%";;



        return i;
    }
    public  static String windSpeed( String s)
    {
        return (Float.parseFloat(s))+getUnit("ws");
    }
    public  static String dewPoint(String s)
    {
        return Float.parseFloat(s)+getUnit("dp");
    }
    public static String humidity( String s)
    {
        String i;

        i =Math.round(Float.parseFloat(s) * 100) + "%";;



        return i;


    }
    public  static String visibility(String s)
    {
        return Float.parseFloat(s)+getUnit("vs");
    }

    public static int getImage(String q)
    {

        int s=0;
        switch (q)
        {
            case "clear-day":
                s=R.drawable.clear;
                break;
            case "clear-night":
                s= R.drawable.clear_night;
                break;
            case "rain":
                s=R.drawable.rain;
                break;
            case "snow":
                s=R.drawable.snow;
                break;
            case "sleet":
                s=R.drawable.sleet;
                break;
            case "wind":
                s=R.drawable.wind;
                break;
            case "fog":
                s=R.drawable.fog;
                break;
            case "cloudy":
                s=R.drawable.cloudy;
                break;
            case "partly-cloudy-day":
                s=R.drawable.cloud_day;
                break;
            case "partly-cloudy-night":
                s=R.drawable.cloud_night;
                break;

        }
        return s;
    }



}
