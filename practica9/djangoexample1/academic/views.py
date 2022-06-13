import datetime
import json

from django.shortcuts import render
from rest_framework import viewsets
from rest_framework.decorators import action
from rest_framework.response import Response
from django.http import HttpResponse
from .models import Professor, Student

# Create your views here.

class StudentViewSet(viewsets.ViewSet):
    # Completar view, newstudent, editstudent
    @action(methods=['get'], detail=False)
    def view(self, request):
        return render(request, 'studentlist.html', {'title': 'Student list'})

    @action(methods=['get'], detail=False)
    def newstudent(self, request):
        return render(request, 'newstudent.html', {'title': 'Student registration'})

    @action(methods=['get'], detail=True)
    def editstudent(self, request, pk=None):
        return render(request, 'editstudent.html', {'title': 'Edit student'})

    #CRUD: Los métodos deben llevar los nombres: list, create, update, delete, retrieve

    def list(self, request):
        students = [s.to_dict() for s in Student.objects.all()]
        return HttpResponse(json.dumps(students), content_type='application/json')

    # Completar create, update, delete, retrieve

    def retrieve(self, request, pk=None):
        student = Student.objects.filter(id=pk).first()
        return HttpResponse(json.dumps(student.to_dict()), content_type='application/json')

    def create(self, request):
        data = request.data
        student = Student(
            first_name=data['firstName'],
            last_name=data['lastName'],
            birth_date=datetime.datetime.strptime(data['birthDate'], '%Y-%m-%d'),
            semester=data['semester']
        )
        student.save()
        return HttpResponse(json.dumps({'result': 'ok'}), content_type='application/json')

    def update(self, request, pk=None):
        data = request.data
        student = Student.objects.filter(id=pk).first()
        student.first_name = data['firstName']
        student.last_name = data['lastName']
        student.birth_date = datetime.datetime.strptime(data['birthDate'], '%Y-%m-%d')
        student.semester = data['semester']
        student.save()
        return HttpResponse(json.dumps({'result': 'ok'}), content_type='application/json')

    def delete(self, request, pk=None):
        student = Student.objects.filter(id=pk).first()
        student.delete()
        return HttpResponse(json.dumps({'result': 'ok'}), content_type='application/json')
   

# Para la práctica
class ProfessorViewSet(viewsets.ViewSet):
    @action(methods=['get'], detail=False)
    def listview(self, req):
       return render(req, 'professorlist.html', {'title': 'Professor List'})
    @action(methods=["get"], detail = False)
    def new(s, req):
        return render(req, 'newprofessor.html', {'title': 'New Professor'})
    @action(methods=["get"], detail = True)
    def edit(s, req, pk):
        return render(req, 'editprofessor.html', {'title': 'Edit Professor'})
    def list(self, req):
        return HttpResponse(json.dumps([i.to_dict() for i in Professor.objects.all()]), content_type="application/json")
    def retrieve(s, req, pk):
        return HttpResponse(json.dumps(s.firstby(id = pk).to_dict()), content_type = "application/json") 
    def create(s, req):
        pdata = req.data
        p = Professor(
            first_name = pdata["firstName"],
            last_name = pdata["lastName"],
            birth_date = datetime.datetime.strptime(pdata["birthDate"], "%Y-%m-%d"),
            salary = float(pdata["salary"])
        )
        p.save()
        return HttpResponse(json.dumps({"res": "ok"}), content_type = "application/json")
    def delete(self, req, pk = None):
        self.firstby(id = pk).delete()
        return HttpResponse(json.dumps({"res": "ok"}), content_type = "application/json")
    def update(s, req, pk):
        pdata = req.data
        p = s.firstby(id = pk)
        p.first_name = pdata["firstName"]
        p.last_name = pdata["lastName"]
        p.birth_date = datetime.datetime.strptime(pdata["birthDate"], "%Y-%m-%d")
        p.salary = float(pdata["salary"])
        p.save()
        return HttpResponse(json.dumps({"res":"ok"}), content_type="application/json")
    def by(s, **kw):
        return Professor.objects.filter(**kw)
    def firstby(s, **kw)->Professor:
        return s.by(**kw).first()
        