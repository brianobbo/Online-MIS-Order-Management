package com.example.restaurant

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.*
import android.widget.ArrayAdapter
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.restaurant.Category.Category_Activity
import kotlinx.android.synthetic.main.activity_cartview.*
class Cart_Activity : AppCompatActivity() {


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_cartview)


        var url = UserInfo.baseUrl + "get_temp.php?mobile=" + UserInfo.mobile
        var list = ArrayList<String>()
        var rq: RequestQueue = Volley.newRequestQueue(this)
        var jar = JsonArrayRequest(Request.Method.GET, url, null, Response.Listener { response ->
            for (index in 0..response.length() - 1) {
                list.add(
                    "Name: " + response.getJSONObject(index).getString("name") + "\n" +
                            "Price: " + response.getJSONObject(index).getString("price") + "\n" +
                            "Qty: " + response.getJSONObject(index).getString("qty")
                )
                var ad = ArrayAdapter(this, android.R.layout.simple_list_item_1, list)
                order_lv.adapter = ad
            }
        }, Response.ErrorListener { error ->
            Toast.makeText(this, error.message, Toast.LENGTH_LONG).show()
        })
        rq.add(jar)



//next to pay pal activity
        next()

    }



    //inflate menu
    override fun onCreateOptionsMenu(menu: Menu?): Boolean {
        menuInflater.inflate(R.menu.my_menu, menu)
        return super.onCreateOptionsMenu(menu)
    }

    //actions when menu iems selected (confirm,back & cancel)
    override fun onOptionsItemSelected(item: MenuItem): Boolean {

        //Back to home
//        if(item.itemId == R.id.item_backToMenu){
//            var i = Intent(this, Cat_Activity::class.java)
//          1  startActivity(i)
//        }


        //cancels the order
        if (item.itemId == R.id.item_cancel) {
            var url = UserInfo.baseUrl + "Cancel_order.php?mobile=" + UserInfo.mobile
            var rq: RequestQueue = Volley.newRequestQueue(this)
            var sr = StringRequest(Request.Method.GET, url, Response.Listener { response ->
                var I = Intent(this, Category_Activity::class.java)
                startActivity(I)

            }, Response.ErrorListener { error ->
                Toast.makeText(this, error.message, Toast.LENGTH_SHORT).show()
            })
            rq.add(sr)
        }

        //Confirms the order
//        if(item.itemId == R.id.item_confirm){
//            var url = UserInfo.baseUrl +"confirm_order.php?mobile=" +UserInfo.mobile
//            var rq:RequestQueue = Volley.newRequestQueue(this)
//            var sr = StringRequest(Request.Method.GET,url,Response.Listener { response ->
//                var i = Intent(this,TotalActivity::class.java)
//                i.putExtra("bno",response)
//                startActivity(i)
//
//            },Response.ErrorListener { error ->
//                Toast.makeText(this,error.message,Toast.LENGTH_SHORT).show()
//            })
//            rq.add(sr)
//
//        }

        return super.onOptionsItemSelected(item)
    }

//confirm order
    fun next(){
        buNext.setOnClickListener {
            var url = UserInfo.baseUrl +"confirm_order.php?mobile=" + UserInfo.mobile
            var rq:RequestQueue = Volley.newRequestQueue(this)
            var sr = StringRequest(Request.Method.GET,url,Response.Listener { response ->
                var i = Intent(this, Paypal_Activity::class.java)
                i.putExtra("bno",response)
                startActivity(i)
                finish()

            },Response.ErrorListener { error ->
                Toast.makeText(this,error.message,Toast.LENGTH_SHORT).show()
            })
            rq.add(sr)
        }
    }


    //when u press bach button delte
    override fun onBackPressed() {
        var I = Intent(this, Category_Activity::class.java)
        startActivity(I)
    }
}
