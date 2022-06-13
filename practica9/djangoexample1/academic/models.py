import datetime
from django.db import models

# Create your models here.

class Student(models.Model):
    first_name = models.CharField(max_length=100)
    last_name = models.CharField(max_length=100)
    birth_date = models.DateField()
    semester = models.IntegerField()

    def to_dict(self):
        return {
            'id': self.id,
            'firstName': self.first_name,
            'lastName': self.last_name,
            'birthDate': self.birth_date.strftime('%Y-%m-%d'),
            'semester': self.semester
        }

# Para la práctica
class Professor(models.Model):
    first_name = models.CharField(max_length=100)
    last_name = models.CharField(max_length=100)
    birth_date:datetime.datetime = models.DateField()
    salary = models.DecimalField(max_digits=8, decimal_places=3)

    def to_dict(s):
        return dict(
            id = s.id,
            firstName = s.first_name,
            lastName = s. last_name,
            birthDate = s.birth_date.strftime('%Y-%m-%d'),
            salary = float(s.salary)
        )
