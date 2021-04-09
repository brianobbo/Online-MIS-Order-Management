package com.example.restaurant.Items

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import androidx.recyclerview.widget.GridLayoutManager
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.Volley
import com.example.restaurant.R
import com.example.restaurant.UserInfo
import kotlinx.android.synthetic.main.activity_items.*


class Item_Activity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_items)


        val cat: String? = intent.getStringExtra("catName")
        var url = UserInfo.baseUrl +"get_items.php?category="+cat

        var list = ArrayList<Items>()

        var rq: RequestQueue = Volley.newRequestQueue(this)
        var jar = JsonArrayRequest(Request.Method.GET,url,null,Response.Listener{ response ->

            for (x in 0..response.length()-1)

                list.add(
                    Items(
                        response.getJSONObject(x).getInt("id"),
                        response.getJSONObject(x).getString("name"),
                        response.getJSONObject(x).getDouble("price"),
                        response.getJSONObject(x).getString("photo")
                    )
                )

            var ad = ItemAdapter(this, list)
            rvItem.layoutManager = GridLayoutManager(this,2)
            rvItem.adapter = ad

        },Response.ErrorListener { error ->
            Toast.makeText(this,error.message,Toast.LENGTH_LONG).show()
        })

        rq.add(jar)

    }
}
