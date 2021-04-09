package com.example.restaurant


import android.app.DialogFragment
import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.restaurant.Category.Category_Activity

/**
 * A simple [Fragment] subclass.
 */
class QtyFragment : DialogFragment() {

    override fun onCreateView(inflater: LayoutInflater, container: ViewGroup?,savedInstanceState: Bundle?): View? {
        var root =  inflater!!.inflate(R.layout.fragment_qty, container, false)

        var et = root.findViewById<EditText>(R.id.et_Qty)
        var btn = root.findViewById<Button>(R.id.bu_Qty)

        btn.setOnClickListener {
            var url = UserInfo.baseUrl +"add_temp.php?mobile="+UserInfo.mobile+"&itemid="+UserInfo.itemId +
                    "&qty="+et.text.toString()
            var rq:RequestQueue = Volley.newRequestQueue(activity)
            var sr = StringRequest(Request.Method.GET,url,Response.Listener { response ->
                var I = Intent(activity,Category_Activity::class.java)

                Toast.makeText(activity,"added qty to cart successfully",Toast.LENGTH_SHORT).show()
                startActivity(I)
                getActivity().finish()



            },Response.ErrorListener { error ->
                Toast.makeText(activity,error.message,Toast.LENGTH_SHORT).show()
            })
            rq.add(sr)

        }

        return root
    }
}
