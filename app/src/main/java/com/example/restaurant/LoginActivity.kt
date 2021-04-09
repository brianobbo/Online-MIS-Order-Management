//
package com.example.restaurant

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.restaurant.Category.Category_Activity
import kotlinx.android.synthetic.main.login_activity.*

class LoginActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.login_activity)

        //Intent to Register Activity if not yet Registered
        buSignUp.setOnClickListener {
            val intent = Intent(this, Register_Activity::class.java)
            startActivity(intent)
        }
//Authentication and Intent to Home if succesfully Registered
        buLogin.setOnClickListener {
            var url = UserInfo.baseUrl +"Login.php?mobile=" + etPhoneLogin.text.toString() + "&password=" + etPasswordLogin.text.toString()

            var rq: RequestQueue = Volley.newRequestQueue(this)
            var sr = StringRequest(Request.Method.GET, url, Response.Listener { response ->

                //checking if user mobile already exists in database is registered
                //if user does not exist
                if (response == ("0")) {
                    Toast.makeText(this, "Login Failure", Toast.LENGTH_LONG).show()
                }

                //if user  exists -> succesful Login
                else {
                    UserInfo.mobile = etPhoneLogin.text.toString()
                    var intent = Intent(this, Category_Activity::class.java)
                    startActivity(intent)
                    finish()
                }

            }, Response.ErrorListener { error ->
                Toast.makeText(this, error.message, Toast.LENGTH_LONG).show()
            })

            rq.add(sr)

        }
    }
}


