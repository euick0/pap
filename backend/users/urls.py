from django.urls import path
from . import views
urlpatterns = [
    path('', views.getUser, name="Get User")
]