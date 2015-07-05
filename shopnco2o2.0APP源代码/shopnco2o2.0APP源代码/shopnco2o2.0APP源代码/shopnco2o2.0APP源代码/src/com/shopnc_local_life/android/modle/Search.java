package com.shopnc_local_life.android.modle;

public class Search {
	
	private String s_id;
	private String s_title;
	public Search() {
	}
	public Search(String s_id, String s_title) {
		super();
		this.s_id = s_id;
		this.s_title = s_title;
	}
	public String getS_id() {
		return s_id;
	}
	public void setS_id(String s_id) {
		this.s_id = s_id;
	}
	public String getS_title() {
		return s_title;
	}
	public void setS_title(String s_title) {
		this.s_title = s_title;
	}
	@Override
	public String toString() {
		return "Search [s_id=" + s_id + ", s_title=" + s_title + "]";
	}

}
