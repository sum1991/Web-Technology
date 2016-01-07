package com.example.surabhi.forecast;

import android.content.Context;
import android.location.Address;
import android.location.Geocoder;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.google.android.gms.maps.model.LatLng;
import com.hamweather.aeris.communication.AerisCallback;
import com.hamweather.aeris.communication.EndpointType;
import com.hamweather.aeris.maps.AerisMapView;
import com.hamweather.aeris.maps.MapViewFragment;
import com.hamweather.aeris.maps.interfaces.OnAerisMapLongClickListener;
import com.hamweather.aeris.maps.interfaces.OnAerisMarkerInfoWindowClickListener;
import com.hamweather.aeris.maps.markers.AerisMarker;
import com.hamweather.aeris.model.AerisResponse;
import com.hamweather.aeris.response.EarthquakesResponse;
import com.hamweather.aeris.response.FiresResponse;
import com.hamweather.aeris.response.StormCellResponse;
import com.hamweather.aeris.response.StormReportsResponse;
import com.hamweather.aeris.tiles.AerisTile;


/**
 * A simple {@link Fragment} subclass.
 * Activities that contain this fragment must implement the
 * {@link mapFragment.OnFragmentInteractionListener} interface
 * to handle interaction events.
 * Use the {@link mapFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class mapFragment extends MapViewFragment implements OnAerisMapLongClickListener,OnAerisMarkerInfoWindowClickListener,AerisCallback {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;
    MapActivity listner;

    private OnFragmentInteractionListener mListener;

    public mapFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment mapFragment.
     */
    // TODO: Rename and change types and number of parameters
    public static mapFragment newInstance(String param1, String param2) {
        mapFragment fragment = new mapFragment();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        Log.d("MAP", "S0");
        View view = inflater.inflate(R.layout.fragment_map, container, false);
        Log.d("MAP","S1");
        mapView = (AerisMapView)view.findViewById(R.id.aerisfragment_map);
        mapView.init(savedInstanceState, AerisMapView.AerisMapType.GOOGLE);
        mapView.setOnAerisMapLongClickListener(this);
        mapView.addLayer(AerisTile.RADSAT);
        Log.d("MAP", "S2");
        initMap();
        Log.d("MAP", "S3");
        return view;
    }

    private void initMap() {
    Log.d("MAP INIT", "S3");



        mapView.moveToLocation(new LatLng(Utilities.lat,Utilities.lon), 10);

        mapView.setOnAerisMapLongClickListener(this);
        mapView.setOnAerisWindowClickListener(this);

    }


    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {
        if (mListener != null) {
            mListener.onFragmentInteraction(uri);
        }
    }

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnFragmentInteractionListener) {
            mListener = (OnFragmentInteractionListener) context;
        } else {
            throw new RuntimeException(context.toString()
                    + " must implement OnFragmentInteractionListener");
        }
    }

    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    @Override
    public void onResult(EndpointType endpointType, AerisResponse aerisResponse) {

    }

    @Override
    public void onMapLongClick(double v, double v1) {

    }

    @Override
    public void wildfireWindowPressed(FiresResponse firesResponse, AerisMarker aerisMarker) {

    }

    @Override
    public void stormCellsWindowPressed(StormCellResponse stormCellResponse, AerisMarker aerisMarker) {

    }

    @Override
    public void stormReportsWindowPressed(StormReportsResponse stormReportsResponse, AerisMarker aerisMarker) {

    }

    @Override
    public void earthquakeWindowPressed(EarthquakesResponse earthquakesResponse, AerisMarker aerisMarker) {

    }

    /**
     * This interface must be implemented by activities that contain this
     * fragment to allow an interaction in this fragment to be communicated
     * to the activity and potentially other fragments contained in that
     * activity.
     * <p/>
     * See the Android Training lesson <a href=
     * "http://developer.android.com/training/basics/fragments/communicating.html"
     * >Communicating with Other Fragments</a> for more information.
     */
    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }
}
